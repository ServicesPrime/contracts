<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\ContractService as ContractServiceModel;
use App\Models\ContractSchool;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContractService
{
    public function createContract(Request $request)
    {
        try {
            // Debug: Imprimir datos recibidos
            Log::info('ContractService - Request data:', $request->all());
            
            $this->validateBaseRequest($request);
            Log::info('ContractService - Base validation passed');

            return DB::transaction(function () use ($request) {
                if ($request->organization === 'jwo') {
                    Log::info('ContractService - Creating JWO contract');
                    return $this->createJWOContract($request);
                } else {
                    Log::info('ContractService - Creating School contract');
                    return $this->createSchoolContract($request);
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
            } else {
                return $this->updateSchoolContract($request, $contract);
            }
        });
    }

    private function createJWOContract(Request $request)
    {
        try {
            Log::info('ContractService - Starting JWO validation');
            $this->validateJWORequest($request);
            Log::info('ContractService - JWO validation passed');
            
            Log::info('ContractService - Creating base contract');
            $contract = $this->createBaseContract($request);
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
        $this->validateSchoolRequest($request);
        
        $contract = $this->createBaseContract($request, 'school');
        $this->attachSchoolData($contract, $request->schoolData);
        
        return $contract;
    }

    private function updateJWOContract(Request $request, Contract $contract)
    {
        $this->validateJWORequest($request);

        // Actualizar contrato base
        $contract->update([
            'contract_number' => $request->contract_number,
            'client_id' => $request->client_id,
            'department' => $request->department,
            'date' => $request->date,
            'start_date' => $request->date,
            'end_date' => $request->date,
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
            'client_id' => $request->client_id,
            'department' => $request->department,
            'start_date' => $request->schoolData['start_date'],
            'end_date' => $request->schoolData['end_date'],
            'date' => $request->date,
        ]);

        // Limpiar servicios si existían
        $contract->contractServices()->delete();

        // Actualizar datos de school
        $contract->contractSchool()->updateOrCreate(
            ['contract_id' => $contract->id],
            [
                'percentage' => $request->schoolData['percentage'],
                'work_days' => $request->schoolData['work_days'],
                'labor_cost' => $request->schoolData['labor_cost'],
                'chemical_cost' => $request->schoolData['chemical_cost'],
                'frequency' => $request->schoolData['frequency'],
            ]
        );

        return $contract;
    }

    private function createBaseContract(Request $request, string $type = 'jwo')
    {
        try {
            $data = [
                'contract_number' => $request->contract_number,
                'client_id' => $request->client_id,
                'department' => $request->department,
                'date' => $request->date,
            ];

            if ($type === 'school') {
                $data['start_date'] = $request->schoolData['start_date'];
                $data['end_date'] = $request->schoolData['end_date'];
            } else {
                $data['start_date'] = $request->date;
                $data['end_date'] = $request->date;
            }

            Log::info('ContractService - Creating contract with data:', $data);
            $contract = Contract::create($data);
            Log::info('ContractService - Contract created successfully with ID: ' . $contract->id);
            
            return $contract;
        } catch (\Exception $e) {
            Log::error('ContractService - Error creating base contract:', [
                'data' => $data ?? [],
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function attachServices(Contract $contract, array $services)
    {
        try {
            Log::info('ContractService - Attaching services:', $services);
            
            foreach ($services as $index => $serviceData) {
                Log::info("ContractService - Processing service {$index}:", $serviceData);
                
                if (!empty($serviceData['service_id'])) {
                    $service = Service::find($serviceData['service_id']);
                    
                    if (!$service) {
                        throw new \Exception("Service with ID {$serviceData['service_id']} not found");
                    }
                    
                    $contractServiceData = [
                        'contract_id' => $contract->id,
                        'service_id' => $serviceData['service_id'],
                        'quantity' => $service->type === 'terms' ? null : ($serviceData['quantity'] ?? null),
                        'unit_price' => $service->type === 'terms' ? null : ($serviceData['unit_price'] ?? null),
                    ];
                    
                    Log::info('ContractService - Creating ContractService with data:', $contractServiceData);
                    
                    $contractService = ContractServiceModel::create($contractServiceData);
                    Log::info('ContractService - ContractService created with ID: ' . $contractService->id);
                }
            }
            
            Log::info('ContractService - All services attached successfully');
        } catch (\Exception $e) {
            Log::error('ContractService - Error attaching services:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    private function attachSchoolData(Contract $contract, array $schoolData)
    {
        ContractSchool::create([
            'contract_id' => $contract->id,
            'percentage' => $schoolData['percentage'],
            'work_days' => $schoolData['work_days'],
            'labor_cost' => $schoolData['labor_cost'],
            'chemical_cost' => $schoolData['chemical_cost'],
            'frequency' => $schoolData['frequency'],
        ]);
    }

    // Validaciones
    private function validateBaseRequest(Request $request, $contractId = null)
    {
        try {
            $uniqueRule = 'required|unique:contracts,contract_number|numeric';
            if ($contractId) {
                $uniqueRule = 'required|unique:contracts,contract_number,' . $contractId . '|numeric';
            }

            Log::info('ContractService - Validating base request with rules:', [
                'contract_number' => $uniqueRule,
                'client_id' => 'required|exists:clients,id',
                'department' => 'required|string|max:255',
                'date' => 'required|date',
                'organization' => 'required|in:jwo,school',
            ]);

            $request->validate([
                'contract_number' => $uniqueRule,
                'client_id' => 'required|exists:clients,id',
                'department' => 'required|string|max:255',
                'date' => 'required|date',
                'organization' => 'required|in:jwo,school',
            ]);
            
            Log::info('ContractService - Base validation completed successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('ContractService - Base validation failed:', [
                'errors' => $e->errors(),
                'data' => $request->all()
            ]);
            throw $e;
        }
    }

    private function validateJWORequest(Request $request)
    {
        try {
            Log::info('ContractService - Validating JWO request');
            
            $request->validate([
                'services' => 'required|array|min:1',
                'services.*.service_id' => 'required|exists:services,id',
            ]);

            Log::info('ContractService - Basic JWO validation passed, checking conditional validation');

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
                            $service = Service::find($serviceId);
                            Log::info("ContractService - Checking service {$serviceId}, type: " . ($service ? $service->type : 'not found'));
                            
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
                            $service = Service::find($serviceId);
                            if ($service && $service->type === 'service' && empty($value)) {
                                $fail('The unit price field is required for service type.');
                            }
                        }
                    }
                ]
            ]);
            
            Log::info('ContractService - JWO validation completed successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('ContractService - JWO validation failed:', [
                'errors' => $e->errors(),
                'data' => $request->all()
            ]);
            throw $e;
        }
    }

    private function validateSchoolRequest(Request $request)
    {
        $request->validate([
            'schoolData.start_date' => 'required|date',
            'schoolData.end_date' => 'required|date|after_or_equal:schoolData.start_date',
            'schoolData.percentage' => 'required|numeric|min:0|max:100',
            'schoolData.work_days' => 'required|string',
            'schoolData.labor_cost' => 'required|numeric|min:0',
            'schoolData.chemical_cost' => 'required|numeric|min:0',
            'schoolData.frequency' => 'required|string',
            'schoolData.cost_per_monthly' => 'required|numeric|min:0',
        ]);
    }
}