<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\ContractService as ContractServiceModel;
use App\Models\ContractSchool;
use App\Models\Service;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContractService
{
    public function createContract(Request $request)
    {
       
        try {
            
            $this->validateBaseRequest($request);
          
            return DB::transaction(function () use ($request) {
                if ($request->organization === 'jwo') {
                    return $this->createJWOContract($request);
                } elseif ($request->organization === 'janitorial-school') {
                    return $this->createSchoolContract($request);
                } else {

                    return $this->createGeneralContract($request);
                }
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('ContractService - Validation Error:', [
                'errors' => $e->errors(),
                'message' => $e->getMessage()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('ContractService - General Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function updateContract(Request $request, Contract $contract)
    {
        $this->validateBaseRequest($request, $contract->id);

        return DB::transaction(function () use ($request, $contract) {
            if ($request->organization === 'jwo') {
                return $this->updateJWOContract($request, $contract);
            } elseif ($request->organization === 'school') {
                return $this->updateSchoolContract($request, $contract);
            }
            // General
            $contract->update([
                'contract_number' => $request->contract_number,
                'client_id'       => $request->client_id,
                'department'      => $request->department,
                'start_date'      => $request->start_date,
                'end_date'        => $request->end_date,
                'date'            => $request->date,
            ]);
            $contract->contractSchool()->delete();
            $contract->contractServices()->delete();
            if (is_array($request->services ?? null)) {
                $this->attachServices($contract, $request->services);
            }
            return $contract;
        });
    }

    private function createJWOContract(Request $request)
    {
        try {
            Log::info('ContractService - Starting JWO validation');
            $this->validateJWORequest($request);
            Log::info('ContractService - JWO validation passed');

            // IMPORTANTE: marcar como 'jwo' para fechas = date
            Log::info('ContractService - Creating base contract (JWO)');
            $contract = $this->createBaseContract($request, 'jwo');
            Log::info('ContractService - Base contract created with ID: ' . $contract->id);

            Log::info('ContractService - Attaching services');
            $this->attachServices($contract, $request->services);
            Log::info('ContractService - Services attached successfully');

            return $contract;
        } catch (\Exception $e) {
            Log::error('ContractService - Error in createJWOContract:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function createSchoolContract(Request $request)
    {
        //dd($request);
        $this->validateSchoolRequest($request);

        $contract = $this->createBaseContract($request, 'school');
        $this->attachSchoolData($contract, $request->schoolData, $request->pages);


        // Servicios escolares, si vienen
        if (is_array($request->services ?? null)) {
            $this->attachServices($contract, $request->services);
        }

        return $contract;
    }

    private function updateJWOContract(Request $request, Contract $contract)
    {
        $this->validateJWORequest($request);


        $contract->update([
            'contract_number' => $request->contract_number,
            'client_id'       => $request->client_id,
            'department'      => $request->department,
            'date'            => $request->date,
            'start_date'      => $request->date,
            'end_date'        => $request->date,
        ]);

        // Limpiar datos de school si existían
        $contract->contractSchool()->delete();

        // Actualizar servicios
        $contract->contractServices()->delete();
        $this->attachServices($contract, $request->services);

        return $contract;
    }

    private function updateSchoolContract(Request $request, Contract $contract)
    {
        $this->validateSchoolRequest($request);

        // Actualizar contrato base
        $contract->update([
            'contract_number' => $request->contract_number,
            'client_id'       => $request->client_id,
            'department'      => $request->department,
            'start_date'      => $request->schoolData['start_date'],
            'end_date'        => $request->schoolData['end_date'],
            'date'            => $request->date,
        ]);

        // Limpiar servicios si existían
        $contract->contractServices()->delete();

        // Actualizar datos de school (incluye cost_per_monthly)
        $contract->contractSchool()->updateOrCreate(
            ['contract_id' => $contract->id],
            [
                'percentage'       => $request->schoolData['percentage'],
                'work_days'        => $request->schoolData['work_days'],
                'labor_cost'       => $request->schoolData['labor_cost'],
                'chemical_cost'    => $request->schoolData['chemical_cost'],
                'frequency'        => $request->schoolData['frequency'],
                'cost_per_monthly' => $request->schoolData['cost_per_monthly'],
            ]
        );

        // Adjuntar servicios si vienen
        if (is_array($request->services ?? null)) {
            $this->attachServices($contract, $request->services);
        }

        return $contract;
    }

    private function createBaseContract(Request $request, string $type = 'general')
    {
        $data = [
            'contract_number' => $request->contract_number,
            'client_id'       => $request->client_id,
            'department'      => $request->department,
            'date'            => $request->date,
        ];

        if ($type === 'school') {
            $data['start_date'] = $request->schoolData['start_date'];
            $data['end_date']   = $request->schoolData['end_date'];
        } elseif ($type === 'jwo') {
            $data['start_date'] = $request->date;
            $data['end_date']   = $request->date;
        } else {
            // general
            $data['start_date'] = $request->start_date;
            $data['end_date']   = $request->end_date;
        }

        Log::info('ContractService - Creating contract with data:', $data);
        return Contract::create($data);
    }

    private function attachServices(Contract $contract, array $services)
    {
        try {
            Log::info('ContractService - Attaching services:', $services);

            foreach ($services as $index => $serviceData) {
                Log::info("ContractService - Processing service {$index}:", $serviceData);

                if (empty($serviceData['service_id'])) {
                    continue;
                }

                $service = Service::find($serviceData['service_id']);
                if (!$service) {
                    throw new \Exception("Service with ID {$serviceData['service_id']} not found");
                }

                $requires = $this->requiresAmounts($service);

                $contractServiceData = [
                    'contract_id' => $contract->id,
                    'service_id'  => $service->id,
                    'quantity'    => $requires ? ($serviceData['quantity'] ?? null) : null,
                    'unit_price'  => $requires ? ($serviceData['unit_price'] ?? null) : null,
                ];

                Log::info('ContractService - Creating ContractService with data:', $contractServiceData);

                $contractService = ContractServiceModel::create($contractServiceData);
                Log::info('ContractService - ContractService created with ID: ' . $contractService->id);
            }

            Log::info('ContractService - All services attached successfully');
        } catch (\Exception $e) {
            Log::error('ContractService - Error attaching services:', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function attachSchoolData(Contract $contract, array $schoolData, array $pages = []): void
    {
        //dd($pages);
        // Guarda los datos de la escuela
        ContractSchool::create([
            'contract_id'      => $contract->id,
            'percentage'       => $schoolData['percentage']       ?? null,
            'work_days'        => $schoolData['work_days']         ?? null,
            'labor_cost'       => $schoolData['labor_cost']        ?? null,
            'chemical_cost'    => $schoolData['chemical_cost']     ?? null,
            'frequency'        => $schoolData['frequency']         ?? null,
            'cost_per_monthly' => $schoolData['cost_per_monthly']  ?? null,
        ]);
        
        // Crea el registro de páginas asociadas al contrato
        if (!empty($pages)) {
            // Quita la palabra "pagina" y deja solo el número
            $cleanPages = array_map(function ($p) {
                return preg_replace('/^pagina/', '', $p);
            }, $pages);
        
            Page::create([
                'contract_id' => $contract->id,
                'page_count'  => implode(',', $cleanPages), // ejemplo: "00,0,1,2,3,4"
            ]);
        }
        
        
    }


    private function requiresAmounts(Service $service): bool
    {
        $list = config('services.types_require_amount', ['service']);
        return in_array((string)$service->type, $list, true);
    }


    private function validateBaseRequest(Request $request, $contractId = null)
    {
        //dd($request);
        $uniqueRule = 'required|unique:contracts,contract_number|numeric';
        if ($contractId) {
            $uniqueRule = 'required|unique:contracts,contract_number,' . $contractId . '|numeric';
        }
        
        $request->validate([
            'contract_number' => $uniqueRule,
            'client_id'       => 'required|exists:clients,id',
            'department'      => 'required|string|max:255',
            'date'            => 'required|date',
            'organization'    => 'required|in:jwo,janitorial-school,general',
        ]);
       
    }

    private function validateJWORequest(Request $request)
    {
        // Validación básica
        $request->validate([
            'services'               => 'required|array|min:1',
            'services.*.service_id'  => 'required|exists:services,id',
        ]);

        // Validación condicional por tipo dinámico
        $request->validate([
            'services.*.quantity' => [
                'nullable',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $index     = explode('.', $attribute)[1];
                    $serviceId = $request->input("services.{$index}.service_id");
                    if (!$serviceId) return;

                    $service = Service::find($serviceId);
                    if ($service && $this->requiresAmounts($service) && empty($value)) {
                        $fail('The quantity field is required for this service type.');
                    }
                }
            ],
            'services.*.unit_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $index     = explode('.', $attribute)[1];
                    $serviceId = $request->input("services.{$index}.service_id");
                    if (!$serviceId) return;

                    $service = Service::find($serviceId);
                    if ($service && $this->requiresAmounts($service) && ($value === null || $value === '')) {
                        $fail('The unit price field is required for this service type.');
                    }
                }
            ]
        ]);
    }

    private function validateSchoolRequest(Request $request)
    {
        
        $request->merge([
            'schoolData' => array_merge([
                'start_date'       => now()->toDateString(),
                'end_date'         => now()->addMonth()->toDateString(),
                'percentage'       => 100,
                'work_days'        => 'Lunes-Viernes',
                'labor_cost'       => 0,
                'chemical_cost'    => 0,
                'frequency'        => 'Mensual',
                'cost_per_monthly' => 0,
            ], $request->input('schoolData', []))
        ]);
        //dd($request);
        $request->validate([
            'schoolData.start_date'     => 'required|date',
            'schoolData.end_date'       => 'required|date|after_or_equal:schoolData.start_date',
            'schoolData.percentage'     => 'required|numeric|min:0|max:100',
            'schoolData.work_days'      => 'required|string',
            'schoolData.labor_cost'     => 'required|numeric|min:0',
            'schoolData.chemical_cost'  => 'required|numeric|min:0',
            'schoolData.frequency'      => 'required|string',
            'schoolData.cost_per_monthly' => 'required|numeric|min:0',
        ]);
        
    }

    private function createGeneralContract(Request $request)
    {
        return $this->createBaseContract($request, 'general');
    }
}
