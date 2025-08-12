<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Contract;
use App\Models\ContractService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use setasign\Fpdi\Tcpdf\Fpdi;

class ContractController extends Controller
{

    // CONTROLADOR CORREGIDO
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contracts = Contract::with([
            'client' => function ($query) {
                $query->with('address'); // Cargar la dirección del cliente
            },
            'contractServices.service.specifications' // CAMBIAR: Cargar servicios a través de la tabla pivote
        ])
            ->when($search, function ($query, $search) {
                $query->where('contract_number', 'like', "%$search%")
                    ->orWhere('department', 'like', "%$search%")
                    ->orWhere('date', 'like', "%$search%")
                    // Buscar por nombre del cliente
                    ->orWhereHas('client', function ($clientQuery) use ($search) {
                        $clientQuery->where('name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
                            ->orWhere('phone', 'like', "%$search%");
                    })
                    // CAMBIAR: Buscar por servicios a través de contractServices
                    ->orWhereHas('contractServices.service', function ($serviceQuery) use ($search) {
                        $serviceQuery->where('service', 'like', "%$search%")
                            ->orWhere('type', 'like', "%$search%");
                    })
                    // Buscar por dirección del cliente
                    ->orWhereHas('client.address', function ($addressQuery) use ($search) {
                        $addressQuery->where('street', 'like', "%$search%")
                            ->orWhere('city', 'like', "%$search%")
                            ->orWhere('state', 'like', "%$search%")
                            ->orWhere('zip_code', 'like', "%$search%");
                    });
            })
            ->orderBy('contract_number', 'desc')
            ->get();
        //dd($contracts);
        return Inertia::render('Contracts/Index', [
            'contracts' => $contracts,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function create()
    {
        // Cargar clientes con sus direcciones
        $clients = Client::with('address')
            ->orderBy('name')
            ->get();

        // Cargar servicios con sus especificaciones
        $services = Service::with('specifications')
            ->orderBy('service')
            ->get();

        $contractNumber = $this->generateContractNumber();
        //dd($contractNumber);
        return Inertia::render('Contracts/Create', [
            'clients' => $clients,
            'services' => $services,
            'contractNumber' => $contractNumber
        ]);
    }

    public function store(Request $request)
    {
        //dd($request);
        // Primero validamos los campos básicos
        $request->validate([
            'contract_number' => 'required|unique:contracts|numeric',
            'client_id' => 'required|exists:clients,id',
            'department' => 'required|string|max:255',
            'date' => 'required|date',
            'services' => 'required|array|min:1',
            'services.*.service_id' => 'required|exists:services,id',
        ]);

        // Validación condicional para quantity y unit_price
        $request->validate([
            'services.*.quantity' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    $serviceId = $request->input("services.{$index}.service_id");

                    if ($serviceId) {
                        $service = \App\Models\Service::find($serviceId);
                        if ($service && $service->type === 'service' && empty($value)) {
                            $fail('The quantity field is required for service type.');
                        }
                    }
                }
            ],
            'services.*.unit_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    $serviceId = $request->input("services.{$index}.service_id");

                    if ($serviceId) {
                        $service = \App\Models\Service::find($serviceId);
                        if ($service && $service->type === 'service' && empty($value)) {
                            $fail('The unit price field is required for service type.');
                        }
                    }
                }
            ]
        ]);

        try {
            DB::beginTransaction();

            // Crear el contrato
            $contract = Contract::create([
                'contract_number' => $request->contract_number,
                'client_id' => $request->client_id,
                'department' => $request->department,
                'date' => $request->date
            ]);

            // Crear los servicios del contrato
            foreach ($request->services as $serviceData) {
                ContractService::create([
                    'contract_id' => $contract->id,
                    'service_id' => $serviceData['service_id'],
                    'quantity' => $serviceData['quantity'],
                    'unit_price' => $serviceData['unit_price']
                    // NO incluir 'subtotal' aquí
                ]);
            }

            DB::commit();

            return redirect()->route('contracts.index')
                ->with('success', 'Contrato creado exitosamente con ' . count($request->services) . ' servicio(s).');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear el contrato: ' . $e->getMessage());
        }
    }

    public function edit(Contract $contract)
    {
        $contract->load(['client.address', 'contractServices.service.specifications']);

        // Formatear la fecha explícitamente
        $contractData = $contract->toArray();
        if ($contract->date) {
            $contractData['date'] = $contract->date->format('Y-m-d');
        }

        $clients = Client::with('address')->orderBy('name')->get();
        $services = Service::with('specifications')->orderBy('service')->get();

        return Inertia::render('Contracts/Create', [
            'contract' => $contractData,  // Usar los datos formateados
            'clients' => $clients,
            'services' => $services
        ]);
    }

    public function update(Request $request, Contract $contract)
    {
        // Primero validamos los campos básicos
        $request->validate([
            'contract_number' => 'required|unique:contracts,contract_number,' . $contract->id . '|numeric',
            'client_id' => 'required|exists:clients,id',
            'department' => 'required|string|max:255',
            'date' => 'required|date',
            'services' => 'required|array|min:1',
            'services.*.service_id' => 'required|exists:services,id',
        ]);

        // Validación condicional para quantity y unit_price
        $request->validate([
            'services.*.quantity' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    $serviceId = $request->input("services.{$index}.service_id");

                    if ($serviceId) {
                        $service = \App\Models\Service::find($serviceId);
                        if ($service && $service->type === 'service' && empty($value)) {
                            $fail('The quantity field is required for service type.');
                        }
                    }
                }
            ],
            'services.*.unit_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1];
                    $serviceId = $request->input("services.{$index}.service_id");

                    if ($serviceId) {
                        $service = \App\Models\Service::find($serviceId);
                        if ($service && $service->type === 'service' && empty($value)) {
                            $fail('The unit price field is required for service type.');
                        }
                    }
                }
            ]
        ]);

        try {
            DB::beginTransaction();

            // Actualizar el contrato
            $contract->update([
                'contract_number' => $request->contract_number,
                'client_id' => $request->client_id,
                'department' => $request->department,
                'date' => $request->date
            ]);

            // Eliminar los servicios existentes
            $contract->contractServices()->delete();

            // Crear los nuevos servicios del contrato
            foreach ($request->services as $serviceData) {
                ContractService::create([
                    'contract_id' => $contract->id,
                    'service_id' => $serviceData['service_id'],
                    'quantity' => $serviceData['quantity'] ?? null,
                    'unit_price' => $serviceData['unit_price'] ?? null
                ]);
            }

            DB::commit();

            return redirect()->route('contracts.index')
                ->with('success', 'Contrato actualizado exitosamente con ' . count($request->services) . ' servicio(s).');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el contrato: ' . $e->getMessage());
        }
    }
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'Contract deleted successfully.');
    }

    private function generateContractNumber()
    {
        $today = now();
        $year = $today->format('Y');
        $month = $today->format('m');
        $day = $today->format('d');

        // Buscar el último contrato ordenado por contract_number
        $lastContract = Contract::orderBy('contract_number', 'desc')->first();

        if ($lastContract) {
            // Extraer los primeros 4 números del último contrato
            preg_match('/^(\d{4})/', $lastContract->contract_number, $matches);
            $lastNumber = isset($matches[1]) ? intval($matches[1]) : 0;
            $nextNumber = $lastNumber + 1;
        } else {
            // Si no hay contratos, empezar desde 0001
            $nextNumber = 1;
        }

        // Formatear: 4 dígitos + mes + día + año
        $sequentialNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        $contractNumber = $sequentialNumber . $month . $day . $year;

        return $contractNumber;
    }

    public function downloadPdf(Contract $contract)
    {
        try {
            // Cargar el contrato con todas las relaciones necesarias
            $contract->load([
                'client.address',
                'contractServices.service.specifications'
            ]);

            // Generar el PDF usando la vista blade
            $pdf = PDF::loadView('contracts.pdf', compact('contract'));

            // Configurar opciones del PDF
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true
            ]);

            // Generar nombre del archivo
            $filename = 'work-order-' . $contract->contract_number . '.pdf';

            // Retornar el PDF para descarga
            return $pdf->download($filename);
        } catch (\Exception $e) {
            // Log del error
            Log::error('Error generando PDF del contrato: ' . $e->getMessage(), [
                'contract_id' => $contract->id,
                'error' => $e->getTraceAsString()
            ]);

            // Retornar error al usuario
            return back()->with('error', 'Error al generar el PDF. Inténtalo de nuevo.');
        }
    }
}
