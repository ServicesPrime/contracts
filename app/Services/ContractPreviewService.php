<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Client;
use App\Models\Service;

class ContractPreviewService
{
    /**
     * Genera el preview HTML del contrato
     */
    public function generatePreview(array $requestData): string
    {
        // Procesar datos del formulario primero para obtener organización
        $formData = $this->processFormData($requestData);
        
        // Procesar y validar páginas según la organización
        $selectedPages = $this->processPages($requestData['pages'] ?? [], $formData['organization']);
        
        // Procesar recursos (logos, imágenes)
        $resources = $this->processResources();
        
        // Cargar cliente completo
        $client = $this->loadClient($formData['client_id']);
        
        // Cargar servicios completos (igual que cliente)
        $services = $this->loadServicesModels($requestData['services'] ?? []);
        
        // Generar HTML
        return $this->renderPreview($selectedPages, $resources, $formData, $client, $services);
    }

    /**
     * Procesa y valida las páginas seleccionadas
     */
    private function processPages($pages, string $organization): array
    {
        // Normalizar: si llega string separado por comas
        if (is_string($pages)) {
            $pages = array_map('trim', explode(',', $pages));
        }

        // Asegurar que sea array
        if (!is_array($pages)) {
            $pages = [];
        }

        // Obtener páginas válidas según la organización
        $validPages = $this->getValidPagesForOrganization($organization);

        // Filtrar páginas válidas
        $selectedPages = array_values(array_intersect($pages, $validPages));

        // Fallback: si no viene nada válido, mostrar página 1 de la organización correspondiente
        if (empty($selectedPages)) {
            $selectedPages = $this->getDefaultPagesForOrganization($organization);
            Log::warning('⚠️ No se recibieron páginas válidas, usando fallback para organización: ' . $organization, [
                'default_pages' => $selectedPages
            ]);
        }

        // Log final de páginas a renderizar
        Log::info('📄 Preview: páginas finales a renderizar', [
            'organization' => $organization,
            'pages_received' => $pages,
            'pages_valid' => $selectedPages,
            'count' => count($selectedPages),
        ]);

        return $selectedPages;
    }

    /**
     * Obtiene las páginas válidas según la organización
     */
    private function getValidPagesForOrganization(string $organization): array
    {
        switch ($organization) {
            case 'janitorial-school':
            case 'school': // Legacy support
                // Páginas de la carpeta contracts (school)
                return [
                    'cover', 'thankyou', 'pagina1', 'pagina2', 'pagina3', 'pagina4',
                    'pagina5', 'pagina6', 'pagina7', 'pagina8', 'pagina9', 'pagina10',
                    'pagina11', 'pagina12', 'pagina13', 'pagina14','pagina16', 'pagina19', 'pagina20'
                ];
                
            case 'jwo':
                // Páginas de la carpeta contractsJWO
                return [
                    'pagina1', 'pagina2', 'pagina3', 'pagina4', 'pagina5',
                    'pagina6', 'pagina7', 'pagina8', 'pagina9', 'pagina10'
                ];
                
            case 'staffing-hospitality':
                // Páginas de la carpeta contractsStaffing (cuando la crees)
                return [
                    'pagina1', 'pagina2', 'pagina3', 'pagina4', 'pagina5'
                ];
                
            default:
                // Fallback a school
                return [
                    'pagina1', 'pagina2', 'pagina3', 'pagina4',
                    'pagina5', 'pagina6', 'pagina7', 'pagina8', 'pagina9', 'pagina10',
                    'pagina11', 'pagina12', 'pagina13', 'pagina16', 'pagina19', 'pagina20'
                ];
        }
    }

    /**
     * Obtiene las páginas por defecto según la organización
     */
    private function getDefaultPagesForOrganization(string $organization): array
    {
        switch ($organization) {
            case 'janitorial-school':
            case 'school':
                return ['pagina1']; // Primera página de contracts
                
            case 'jwo':
                return ['pagina1']; // Primera página de contractsJWO
                
            case 'staffing-hospitality':
                return ['pagina1']; // Primera página de contractsStaffing
                
            default:
                return ['pagina1'];
        }
    }

    /**
     * Procesa los recursos (logos, imágenes)
     */
    private function processResources(): array
    {
        $logoPath = storage_path('app/public/Prime.png');
        $bldgPath = storage_path('app/public/Edificio.png');

        $logo64 = file_exists($logoPath)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : '';
        
        $bldg64 = file_exists($bldgPath)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($bldgPath))
            : '';

        return [
            'logo64' => $logo64,
            'bldg64' => $bldg64,
        ];
    }

    /**
     * Procesa los datos del formulario
     */
    private function processFormData(array $requestData): array
    {
        $formData = [
            'contract_number' => $requestData['contract_number'] ?? '',
            'client_id'       => $requestData['client_id'] ?? '',
            'department'      => $requestData['department'] ?? '',
            'date'            => $requestData['date'] ?? '',
            'services'        => $requestData['services'] ?? [], // Solo IDs y datos de formulario
            'organization'    => $requestData['organization'] ?? '',
            'contract_id'     => $requestData['contract_id'] ?? '',
            'isPreview'       => $requestData['isPreview'] ?? false,
        ];

        Log::info('📝 Form data procesada', [
            'contract_number' => $formData['contract_number'],
            'client_id' => $formData['client_id'],
            'organization' => $formData['organization'],
            'services_count' => count($formData['services']),
        ]);

        return $formData;
    }

    /**
     * Carga el objeto Client completo
     */
    private function loadClient(?string $clientId): ?Client
    {
        if (empty($clientId)) {
            return null;
        }

        try {
            return Client::findOrFail($clientId);
        } catch (ModelNotFoundException $e) {
            Log::warning('⚠️ client_id no encontrado', [
                'client_id' => $clientId
            ]);
            return null;
        }
    }

    /**
     * Carga los modelos Service completos con especificaciones (igual que Client)
     */
    private function loadServicesModels(array $servicesData): array
    {
        if (empty($servicesData)) {
            return [];
        }

        $loadedServices = [];
        
        foreach ($servicesData as $serviceData) {
            $serviceId = $serviceData['service_id'] ?? null;
            
            if (!$serviceId) {
                continue;
            }

            try {
                // Cargar el servicio completo con especificaciones (igual que Client::findOrFail)
                $service = Service::with('specifications')->findOrFail($serviceId);
                
                // Agregar datos del formulario como propiedades del modelo
                $service->form_quantity = $serviceData['quantity'] ?? '';
                $service->form_unit_price = $serviceData['unit_price'] ?? '';
                $service->form_data = $serviceData;
                
                $loadedServices[] = $service;
                
            } catch (ModelNotFoundException $e) {
                Log::warning('⚠️ Service ID no encontrado', [
                    'service_id' => $serviceId
                ]);
                continue;
            }
        }

        Log::info('📋 Servicios cargados como modelos completos para preview', [
            'count' => count($loadedServices),
            'services' => array_map(function($service) {
                return [
                    'id' => $service->id,
                    'service' => $service->service,
                    'type' => $service->type,
                    'specifications_count' => $service->specifications ? $service->specifications->count() : 0,
                    'form_quantity' => $service->form_quantity ?? '',
                    'form_unit_price' => $service->form_unit_price ?? ''
                ];
            }, $loadedServices)
        ]);

        return $loadedServices;
    }

    /**
     * Renderiza el preview HTML
     */
    private function renderPreview(array $selectedPages, array $resources, array $formData, ?Client $client, array $services = []): string
    {
        try {
            // Validar que exista organization
            $organization = $formData['organization'] ?? null;
            if (!$organization) {
                throw new \InvalidArgumentException('Falta organization en formData.');
            }

            // Forzar isPreview a 1
            $isPreview = 1;
            $formData['isPreview'] = $isPreview;

            // Determinar la vista
            $viewPath = $this->getViewPath($organization);

            // Renderizar la vista
            return view($viewPath, [
                'selectedPages'   => $selectedPages,
                'logo64'          => $resources['logo64'] ?? null,
                'bldg64'          => $resources['bldg64'] ?? null,

                'formData'        => $formData,
                'contract_number' => $formData['contract_number'] ?? null,
                'client_id'       => $formData['client_id'] ?? null,
                'department'      => $formData['department'] ?? null,
                'date'            => $formData['date'] ?? null,

                'services'        => $services, // Modelos Service completos (igual que $client)
                'organization'    => $organization,

                'isPreview'       => $isPreview,
                'client'          => $client, // Modelo Client completo
            ])->render();

        } catch (\Throwable $e) {
            Log::error('❌ Error al renderizar preview', [
                'organization' => $formData['organization'] ?? 'NOT_SET',
                'error'        => $e->getMessage(),
                'trace'        => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    /**
     * Determina la ruta de la vista según la organización
     */
    private function getViewPath(string $organization): string
    {
        switch ($organization) {
            case 'janitorial-school':
            case 'school': // Legacy support
                return 'contracts.pdf-selected';
                
            case 'jwo':
                return 'contractsJWO.pdf';
                
            case 'staffing-hospitality':
                return 'contractsStaffing.pdf'; // Para cuando lo crees
                
            default:
                Log::warning('⚠️ Organización no reconocida, usando vista por defecto', [
                    'organization' => $organization
                ]);
                return 'contracts.pdf-selected';
        }
    }

    /**
     * MÉTODO LEGACY - Mantener por compatibilidad pero ya no se usa
     */
    private function loadServices(array $servicesData): array
    {
        // Este método ya no se usa, pero se mantiene por compatibilidad
        return [];
    }
}