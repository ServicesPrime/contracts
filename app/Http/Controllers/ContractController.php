<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contract;
use App\Models\Service;
use App\Services\ContractService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ContractController extends Controller
{
    protected $contractService;

    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $contracts = Contract::with([
            'client' => function ($query) {
                $query->with('address');
            },
            'contractServices.service.specifications',
            'contractSchool'
        ])
            ->when($search, function ($query, $search) {
                $query->where('contract_number', 'like', "%$search%")
                    ->orWhere('department', 'like', "%$search%")
                    ->orWhere('date', 'like', "%$search%")
                    ->orWhereHas('client', function ($clientQuery) use ($search) {
                        $clientQuery->where('name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
                            ->orWhere('phone', 'like', "%$search%");
                    })
                    ->orWhereHas('contractServices.service', function ($serviceQuery) use ($search) {
                        $serviceQuery->where('service', 'like', "%$search%")
                            ->orWhere('type', 'like', "%$search%");
                    })
                    ->orWhereHas('client.address', function ($addressQuery) use ($search) {
                        $addressQuery->where('street', 'like', "%$search%")
                            ->orWhere('city', 'like', "%$search%")
                            ->orWhere('state', 'like', "%$search%")
                            ->orWhere('zip_code', 'like', "%$search%");
                    });
            })
            ->orderBy('contract_number', 'desc')
            ->get();


        $contracts = $contracts->map(function ($contract) {
            $contract->contract_type = $contract->contractSchool ? 'school' : 'jwo';
            if ($contract->contract_type === 'school') {
                $contract->total_amount = $contract->contractSchool ?
                    ($contract->contractSchool->labor_cost + $contract->contractSchool->chemical_cost) : 0;
                $contract->description = $contract->contractSchool ?
                    $contract->contractSchool->frequency : 'School Contract';
            } else {
                $contract->total_amount = $contract->contractServices->sum(function ($cs) {
                    return ($cs->quantity ?? 0) * ($cs->unit_price ?? 0);
                });
                $serviceCount = $contract->contractServices->count();
                $contract->description = "{$serviceCount} service(s)";
            }

            return $contract;
        });

        return Inertia::render('Contracts/Index', [
            'contracts' => $contracts,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function create()
    {
        $clients = Client::with('address')->orderBy('name')->get();
        $services = Service::with('specifications')->orderBy('service')->get();
        $contractNumber = $this->generateContractNumber();


        return Inertia::render('Contracts/Create', [
            'clients' => $clients,
            'services' => $services,
            'contractNumber' => $contractNumber
        ]);
    }

    public function store(Request $request)
    {

        try {

            $contract = $this->contractService->createContract($request);
            return redirect()->route('contracts.index')
                ->with('success', 'Contract created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Controller - Validation errors:', $e->errors());

            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validation failed: ' . implode(', ', array_keys($e->errors())));
        } catch (\Exception $e) {
            Log::error('Controller - General error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'Failed to create contract: ' . $e->getMessage()])
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(Contract $contract)
    {
        // Cargar relaciones según el tipo de contrato
        $contract->load(['client.address', 'contractServices.service.specifications', 'contractSchool']);

        // Formatear la fecha explícitamente
        $contractData = $contract->toArray();
        if ($contract->date) {
            $contractData['date'] = $contract->date->format('Y-m-d');
        }
        if ($contract->start_date) {
            $contractData['start_date'] = $contract->start_date->format('Y-m-d');
        }
        if ($contract->end_date) {
            $contractData['end_date'] = $contract->end_date->format('Y-m-d');
        }

        // Determinar el tipo de organización
        $contractData['organization'] = $contract->contractSchool ? 'school' : 'jwo';

        // Si es un contrato school, formatear los datos
        if ($contract->contractSchool) {
            $contractData['schoolData'] = [
                'start_date' => $contract->start_date ? $contract->start_date->format('Y-m-d') : '',
                'end_date' => $contract->end_date ? $contract->end_date->format('Y-m-d') : '',
                'percentage' => $contract->contractSchool->percentage,
                'work_days' => $contract->contractSchool->work_days,
                'labor_cost' => $contract->contractSchool->labor_cost,
                'chemical_cost' => $contract->contractSchool->chemical_cost,
                'frequency' => $contract->contractSchool->frequency,
                'cost_per_monthly' => 0
            ];
        }

        $clients = Client::with('address')->orderBy('name')->get();
        $services = Service::with('specifications')->orderBy('service')->get();

        return Inertia::render('Contracts/Create', [
            'contract' => $contractData,
            'clients' => $clients,
            'services' => $services
        ]);
    }

    public function update(Request $request, Contract $contract)
    {
        try {
            $this->contractService->updateContract($request, $contract);

            return redirect()->route('contracts.index')
                ->with('success', 'Contract updated successfully!');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Failed to update contract: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'Contract deleted successfully.');
    }

    public function downloadPdf(Contract $contract)
    {

        try {
            $contract->load([
                'client.address',
                'contractServices.service.specifications',
                'contractSchool',
                'page'
            ]);


            $isSchoolContract = $contract->contractSchool !== null;

            if ($isSchoolContract) {

                // Vista para contratos School
                $pages = $contract->page ? array_values(array_filter(explode(',', (string) $contract->page->page_count), fn($v) => $v !== '')) : [];
                
                $pdf   = PDF::loadView('contracts.pdf', compact('contract', 'pages'));
                $filename = 'school-contract-' . $contract->contract_number . '.pdf';
            } else {
                // Vista para contratos JWO
                $pdf = PDF::loadView('contracts.pagina25', compact('contract'));
                $filename = 'work-order-' . $contract->contract_number . '.pdf';
            }

            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true
            ]);

            return $pdf->download($filename);
        } catch (\Exception $e) {
            Log::error('Error generando PDF del contrato: ' . $e->getMessage(), [
                'contract_id' => $contract->id,
                'contract_type' => $contract->contractSchool ? 'school' : 'jwo',
                'error' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Error al generar el PDF. Inténtalo de nuevo.');
        }
    }

    private function generateContractNumber()
    {
        $today = now();
        $year = $today->format('Y');
        $month = $today->format('m');
        $day = $today->format('d');

        $lastContract = Contract::orderBy('contract_number', 'desc')->first();

        if ($lastContract) {
            preg_match('/^(\d{4})/', $lastContract->contract_number, $matches);
            $lastNumber = isset($matches[1]) ? intval($matches[1]) : 0;
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $sequentialNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        $contractNumber = $sequentialNumber . $month . $day . $year;

        return $contractNumber;
    }
}
