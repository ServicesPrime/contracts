<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Contract;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;
use setasign\Fpdi\Tcpdf\Fpdi;

class ContractController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $contracts = Contract::with([
            'client' => function ($query) {
                $query->with('address'); // Cargar la dirección del cliente
            },
            'service' // Cargar el servicio relacionado
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
                    // Buscar por servicio
                    ->orWhereHas('service.specifications', function ($serviceQuery) use ($search) {
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

        return Inertia::render('Contracts/Create', [
            'clients' => $clients,
            'services' => $services
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'contract_number' => 'required|unique:contracts|numeric',
            'client_id' => 'required|exists:clients,id',
            'department' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'product_quantity' => 'required|integer|min:1',
            'product_cost' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $contract = Contract::create([
            'contract_number' => $request->contract_number,
            'client_id' => $request->client_id,
            'department' => $request->department,
            'service_id' => $request->service_id,
            'product_quantity' => $request->product_quantity,
            'product_cost' => $request->product_cost,
            'date' => $request->date,
        ]);

        return redirect()->route('contracts.index')
            ->with('success', 'Contract created successfully.');
    }

    public function edit(Contract $contract)
    {
        // Cargar el contrato con sus relaciones
        $contract->load(['client.address', 'service.specifications']);

        // Cargar clientes y servicios para los selectores
        $clients = Client::with('address')
            ->orderBy('name')
            ->get();

        $services = Service::with('specifications')
            ->orderBy('service')
            ->get();

        return Inertia::render('Contracts/Create', [
            'contract' => $contract,
            'clients' => $clients,
            'services' => $services
        ]);
    }

    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'contract_number' => 'required|unique:contracts,contract_number,' . $contract->id . '|numeric',
            'client_id' => 'required|exists:clients,id',
            'department' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'product_quantity' => 'required|integer|min:1',
            'product_cost' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $contract->update([
            'contract_number' => $request->contract_number,
            'client_id' => $request->client_id,
            'department' => $request->department,
            'service_id' => $request->service_id,
            'product_quantity' => $request->product_quantity,
            'product_cost' => $request->product_cost,
            'date' => $request->date,
        ]);

        return redirect()->route('contracts.index')
            ->with('success', 'Contract updated successfully.');
    }
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'Contract deleted successfully.');
    }




    // O si prefieres mantener el mismo formato, puedes hacer esto:
    public function generatePDFCompatible($contractId)
    {
        $contract = Contract::with([
            'client.address',
            'service.specifications'
        ])->findOrFail($contractId);

        // Crear un objeto que simule la estructura anterior para mantener compatibilidad
        $contractForPDF = (object) [
            'id' => $contract->id,
            'contract_number' => $contract->contract_number,
            'name' => $contract->client->name,  // Mapear cliente->name a name
            'location' => $contract->client->address->full_address,  // Mapear dirección a location
            'department' => $contract->department,
            'product_description' => $contract->service->service,  // Mapear servicio a product_description
            'product_quantity' => $contract->product_quantity,
            'product_cost' => $contract->product_cost,
            'date' => $contract->date,

            // Datos adicionales que ahora tienes disponibles
            'client' => $contract->client,
            'service' => $contract->service,
            'address' => $contract->client->address,
        ];

        $pdf = PDF::loadView('contracts.pdf', ['contract' => $contractForPDF]);

        return $pdf->download('contract_' . $contract->contract_number . '.pdf');
    }

    public function generateContract($contractId)
    {
        $contract = Contract::with(['client.address', 'service.specifications'])->findOrFail($contractId);
        
        // Crear instancia de FPDI (que extiende TCPDF)
        $pdf = new Fpdi('P', 'mm', 'A4', true, 'UTF-8', false);
        
        // Configurar el PDF
        $pdf->SetCreator('Tu Empresa');
        $pdf->SetAuthor('Sistema de Contratos');
        $pdf->SetTitle('Work Order - ' . $contract->contract_number);
        
        // Remover header y footer por defecto
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Configurar márgenes
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(false, 0);
        
        // Agregar página
        $pdf->AddPage();
        
        // Usar el template como fondo
        $templatePath = storage_path('app/public/template/template contracts1.pdf');
        
        // Importar el template (requiere TCPDI o similar)
        $pageCount = $pdf->setSourceFile($templatePath);
        $templateId = $pdf->importPage(1);
        $pdf->useTemplate($templateId, 0, 0);
        
        // Ahora agregar el texto sobre el template
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        
        // WORK SITE (ajusta las coordenadas según tu template)
        $pdf->SetXY(20, 45); // X, Y en milímetros
        $workSite = $contract->client->address->street ?? 'No street address';
        $workSite .= "\n" . ($contract->client->address->city ?? '') . 
                    ($contract->client->address->city && $contract->client->address->state ? ', ' : '') . 
                    ($contract->client->address->state ?? '') . ' ' . 
                    ($contract->client->address->zip_code ?? '');
        $pdf->MultiCell(50, 10, $workSite, 0, 'L');
        
        // BILL TO
        $pdf->SetXY(85, 45);
        $billTo = ($contract->client->name ?? 'No client name') . "\n";
        $billTo .= "Email: " . ($contract->client->email ?? 'No email') . "\n";
        $billTo .= "Phone: " . ($contract->client->phone ?? 'No phone') . "\n";
        $billTo .= "Area: " . ($contract->client->area ?? 'No area');
        $pdf->MultiCell(50, 10, $billTo, 0, 'L');
        
        // WORK ORDER NUMBER
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetXY(150, 55);
        $pdf->Cell(40, 10, $contract->contract_number, 0, 0, 'C');
        
        // Otros campos (ajusta coordenadas)
        $pdf->SetFont('helvetica', '', 10);
        
        // WORK O. DATE
        $pdf->SetXY(20, 80);
        $pdf->Cell(40, 10, \Carbon\Carbon::parse($contract->date)->format('m/d/Y'));
        
        // REQUESTED BY
        $pdf->SetXY(85, 80);
        $pdf->Cell(40, 10, $contract->client->name ?? 'No client name');
        
        // DEPARTMENT
        $pdf->SetXY(150, 80);
        $pdf->Cell(40, 10, $contract->department);
        
        // SERVICE
        $pdf->SetXY(20, 120);
        $service = $contract->service->service ?? 'No service specified';
        if($contract->service->type) {
            $service .= ' (' . ($contract->service->type === 'service' ? 'Service' : 'Terms & Conditions') . ')';
        }
        $pdf->Cell(160, 10, $service);
        
        // Especificaciones
        if($contract->service && $contract->service->specifications && count($contract->service->specifications) > 0) {
            $y = 135;
            foreach($contract->service->specifications as $specification) {
                $pdf->SetXY(25, $y);
                $pdf->Cell(150, 5, "• " . $specification->description);
                $y += 5;
            }
        }
        
        // Tabla de contrato (ajustar coordenadas según tu template)
        $pdf->SetXY(20, 180);
        
        // Location
        $location = ($contract->client->address->city ?? 'No location') . 
                   ($contract->client->address->city && $contract->client->address->state ? ', ' : '') . 
                   ($contract->client->address->state ?? '');
        $pdf->Cell(30, 10, $location, 0, 0, 'C');
        
        // Type of Service
        $pdf->SetXY(50, 180);
        $pdf->Cell(30, 10, $contract->service->service ?? 'No service', 0, 0, 'C');
        
        // Frequency
        $pdf->SetXY(80, 180);
        $pdf->Cell(30, 10, 'Monthly', 0, 0, 'C');
        
        // Qty
        $pdf->SetXY(110, 180);
        $pdf->Cell(20, 10, $contract->product_quantity, 0, 0, 'C');
        
        // Rate
        $pdf->SetXY(130, 180);
        $pdf->Cell(25, 10, '$' . number_format($contract->product_cost, 2), 0, 0, 'C');
        
        // Total
        $pdf->SetXY(155, 180);
        $pdf->Cell(25, 10, '$' . number_format($contract->product_cost * $contract->product_quantity, 2), 0, 0, 'C');
        
        // Generar el PDF
        return $pdf->Output('work_order_' . $contract->contract_number . '.pdf', 'I');
    }



    
    public function generatePdf($id)
    {
        try {
            // Obtener el contrato con todas sus relaciones
            $contract = Contract::with(['client.address', 'service.specifications'])->findOrFail($id);
            
            // Crear instancia de FPDI
            $pdf = new Fpdi('P', 'mm', 'A4', true, 'UTF-8', false);
            
            // Configurar el PDF
            $pdf->SetCreator('Your Company');
            $pdf->SetAuthor('Contract Management System');
            $pdf->SetTitle('Work Order - ' . $contract->contract_number);
            $pdf->SetSubject('Work Order Contract');
            
            // Remover header y footer por defecto
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            
            // Configurar márgenes
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetAutoPageBreak(false, 0);
            
            // Agregar página
            $pdf->AddPage();
            
            // Usar el template como fondo
            $templatePath = storage_path('app/public/template/template contracts1.pdf');
            
            // Verificar que el template existe
            if (!file_exists($templatePath)) {
                throw new \Exception('Template PDF not found at: ' . $templatePath);
            }
            
            // Importar el template
            $pageCount = $pdf->setSourceFile($templatePath);
            $templateId = $pdf->importPage(1);
            $pdf->useTemplate($templateId, 0, 0);
            
            // Configurar fuente y color por defecto
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(0, 0, 0);
            
            // WORK SITE (columna izquierda)
            $pdf->SetXY(20, 50); // Ajustar estas coordenadas según tu template
            $workSite = ($contract->client->address->street ?? 'No street address') . "\n";
            $workSite .= ($contract->client->address->city ?? '') . 
                        ($contract->client->address->city && $contract->client->address->state ? ', ' : '') . 
                        ($contract->client->address->state ?? '') . ' ' . 
                        ($contract->client->address->zip_code ?? '') . "\n";
            $workSite .= ($contract->client->address->country ?? '');
            $pdf->MultiCell(60, 4, $workSite, 0, 'L');
            
            // BILL TO (columna central)
            $pdf->SetXY(85, 50); // Ajustar coordenadas
            $billTo = ($contract->client->name ?? 'No client name') . "\n";
            $billTo .= "Email: " . ($contract->client->email ?? 'No email') . "\n";
            $billTo .= "Phone: " . ($contract->client->phone ?? 'No phone') . "\n";
            $billTo .= "Area: " . ($contract->client->area ?? 'No area');
            $pdf->MultiCell(60, 4, $billTo, 0, 'L');
            
            // WORK ORDER NUMBER (columna derecha)
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetTextColor(185, 31, 50); // Color rojo del template
            $pdf->SetXY(150, 60); // Ajustar coordenadas
            $pdf->Cell(40, 10, $contract->contract_number, 0, 0, 'C');
            
            // Resetear color y fuente
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetTextColor(0, 0, 0);
            
            // WORK O. DATE
            $pdf->SetXY(20, 85); // Ajustar coordenadas
            $pdf->Cell(50, 5, \Carbon\Carbon::parse($contract->date)->format('m/d/Y'));
            
            // REQUESTED BY
            $pdf->SetXY(85, 85); // Ajustar coordenadas
            $pdf->Cell(50, 5, $contract->client->name ?? 'No client name');
            
            // DEPARTMENT
            $pdf->SetXY(150, 85); // Ajustar coordenadas
            $pdf->Cell(50, 5, $contract->department ?? '');
            
            // INVOICE # FOR BILL
            $pdf->SetXY(20, 100); // Ajustar coordenadas
            $pdf->Cell(50, 5, $contract->contract_number);
            
            // TERMS
            $pdf->SetXY(110, 100); // Ajustar coordenadas
            $pdf->Cell(30, 5, '15');
            
            // SERVICE
            $pdf->SetXY(20, 125); // Ajustar coordenadas
            $service = $contract->service->service ?? 'No service specified';
            if(isset($contract->service->type)) {
                $service .= ' (' . ($contract->service->type === 'service' ? 'Service' : 'Terms & Conditions') . ')';
            }
            $pdf->Cell(170, 5, $service);
            
            // Especificaciones
            if(isset($contract->service->specifications) && count($contract->service->specifications) > 0) {
                $y = 135; // Coordenada Y inicial para especificaciones
                foreach($contract->service->specifications as $specification) {
                    $pdf->SetXY(25, $y);
                    $pdf->Cell(160, 4, "• " . $specification->description);
                    $y += 5; // Incrementar Y para la siguiente línea
                }
            }
            
            // Datos de la tabla (ajustar según la posición de tu tabla en el template)
            $tableY = 180; // Ajustar según tu template
            
            // Location
            $pdf->SetXY(20, $tableY);
            $location = ($contract->client->address->city ?? 'No location') . 
                       ($contract->client->address->city && $contract->client->address->state ? ', ' : '') . 
                       ($contract->client->address->state ?? '');
            $pdf->Cell(35, 8, $location, 0, 0, 'C');
            
            // Type of Service
            $pdf->SetXY(55, $tableY);
            $pdf->Cell(35, 8, $contract->service->service ?? 'No service', 0, 0, 'C');
            
            // Frequency
            $pdf->SetXY(90, $tableY);
            $pdf->Cell(25, 8, 'Monthly', 0, 0, 'C');
            
            // Qty
            $pdf->SetXY(115, $tableY);
            $pdf->Cell(20, 8, $contract->product_quantity, 0, 0, 'C');
            
            // Rate
            $pdf->SetXY(135, $tableY);
            $pdf->Cell(25, 8, '$' . number_format($contract->product_cost, 2), 0, 0, 'C');
            
            // Total
            $pdf->SetXY(160, $tableY);
            $pdf->Cell(30, 8, '$' . number_format($contract->product_cost * $contract->product_quantity, 2), 0, 0, 'C');
            
            // Generar el PDF y enviarlo al navegador
            $filename = 'work_order_' . $contract->contract_number . '.pdf';
            
            return response($pdf->Output($filename, 'S'))
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
                
        } catch (\Exception $e) {
            // En caso de error, retornar un mensaje de error
            return response()->json([
                'error' => 'Error generating PDF: ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Método adicional para descargar el PDF (opcional)
    public function downloadPdf($id)
    {
        try {
            $contract = Contract::with(['client.address', 'service.specifications'])->findOrFail($id);
            
            
            
            $filename = 'work_order_' . $contract->contract_number . '.pdf';
            
            // La diferencia es usar 'attachment' en lugar de 'inline'
            return response($pdf->Output($filename, 'S'))
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Error downloading PDF: ' . $e->getMessage());
        }
    }
    
    // Método para probar coordenadas (temporal)
    public function testCoordinates()
    {
        // Crear instancia de FPDI
        $pdf = new Fpdi('P', 'mm', 'A4', true, 'UTF-8', false);
        
        // Configurar el PDF
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetAutoPageBreak(false, 0);
        $pdf->AddPage();
        
        // Usar el template como fondo
        $templatePath = storage_path('app/public/template/template contracts1.pdf');
        
        try {
            // Importar el template
            $pageCount = $pdf->setSourceFile($templatePath);
            $templateId = $pdf->importPage(1);
            $pdf->useTemplate($templateId, 0, 0);
            
            // Crear una cuadrícula para identificar coordenadas
            $pdf->SetDrawColor(255, 0, 0); // Líneas rojas
            $pdf->SetLineWidth(0.1);
            
            // Líneas verticales cada 10mm
            for ($x = 0; $x <= 210; $x += 10) {
                $pdf->Line($x, 0, $x, 297);
                if ($x % 20 == 0) {
                    $pdf->SetFont('helvetica', '', 6);
                    $pdf->SetXY($x, 2);
                    $pdf->Cell(10, 5, $x, 0, 0, 'C');
                }
            }
            
            // Líneas horizontales cada 10mm
            for ($y = 0; $y <= 297; $y += 10) {
                $pdf->Line(0, $y, 210, $y);
                if ($y % 20 == 0) {
                    $pdf->SetFont('helvetica', '', 6);
                    $pdf->SetXY(2, $y);
                    $pdf->Cell(10, 5, $y, 0, 0, 'L');
                }
            }
            
            return response($pdf->Output('test_coordinates.pdf', 'S'))
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="test_coordinates.pdf"');
                
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()]);
        }
    }


}
