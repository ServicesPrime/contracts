<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Client;

class ContractPreviewController extends Controller
{
    public function preview(Request $request)
    {
        // Log para debugging del request
        Log::info('🚀 Preview Controller - Datos recibidos', [
            'method' => $request->method(),
            'all_data' => $request->all(),
            'pages_input' => $request->input('pages'),
            'pages_array' => $request->input('pages', []),
            'has_pages' => $request->has('pages'),
        ]);

        // Obtener páginas del request
        $pages = $request->input('pages', []);

        // Normalizar: si llega string separado por comas
        if (is_string($pages)) {
            $pages = array_map('trim', explode(',', $pages));
        }

        // Asegurar que sea array
        if (!is_array($pages)) {
            $pages = [];
        }

        // Validar solo páginas conocidas
        $validPages = [
            'cover', 'thankyou', 'pagina1', 'pagina2', 'pagina3', 'pagina4',
            'pagina5', 'pagina6', 'pagina7', 'pagina8', 'pagina9', 'pagina10',
            'pagina11', 'pagina12', 'pagina13', 'pagina16', 'pagina19', 'pagina20'
        ];

        // Filtrar páginas válidas
        $selectedPages = array_values(array_intersect($pages, $validPages));

        // Fallback: si no viene nada válido, mostrar pagina1
        if (empty($selectedPages)) {
            $selectedPages = ['pagina1'];
            Log::warning('⚠️ No se recibieron páginas válidas, usando fallback: pagina1');
        }

        // Log final de páginas a renderizar
        Log::info('📄 Preview: páginas finales a renderizar', [
            'pages_received' => $pages,
            'pages_valid' => $selectedPages,
            'count' => count($selectedPages),
        ]);

        // Recursos (logos, imágenes)
        $logoPath = storage_path('app/public/Prime.png');
        $bldgPath = storage_path('app/public/Edificio.png');

        $logo64 = file_exists($logoPath)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : '';
        $bldg64 = file_exists($bldgPath)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($bldgPath))
            : '';

        // Datos del formulario
        $formData = [
            'contract_number' => $request->input('contract_number', ''),
            'client_id'       => $request->input('client_id', ''),
            'department'      => $request->input('department', ''),
            'date'            => $request->input('date', ''),
            'services'        => $request->input('services', []),
            'organization'    => $request->input('organization', ''),
            'contract_id'     => $request->input('contract_id', ''),
        ];

        Log::info('📝 Form data pasada a la vista', $formData);

        // ==== Cargar el objeto Client completo (con address por scope global) ====
        $client = null;
        if (!empty($formData['client_id'])) {
            try {
                $client = Client::findOrFail($formData['client_id']); // con scope global trae address
            } catch (ModelNotFoundException $e) {
                Log::warning('⚠️ client_id no encontrado', [
                    'client_id' => $formData['client_id']
                ]);
            }
        } else {
            Log::info('ℹ️ No se envió client_id; se continuará sin cliente');
        }
        // ========================================================================

        //dump($client);
        try {
            // Renderizar vista con todos los datos
            $html = view('contracts.pdf-selected', [
                'selectedPages'   => $selectedPages,
                'logo64'          => $logo64,
                'bldg64'          => $bldg64,

                // Datos del formulario
                'formData'        => $formData,
                'contract_number' => $formData['contract_number'],
                'client_id'       => $formData['client_id'],
                'department'      => $formData['department'],
                'date'            => $formData['date'],
                'services'        => $formData['services'],
                'organization'    => $formData['organization'],

                // Objeto cliente completo
                'client'          => $client,
            ])->render();

            Log::info('✅ Vista renderizada exitosamente', [
                'pages_count' => count($selectedPages),
                'html_length' => strlen($html),
                'has_client'  => (bool) $client,
            ]);

            return $html;

        } catch (\Exception $e) {
            Log::error('❌ Error al renderizar vista', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'selectedPages' => $selectedPages
            ]);

            return response()->json([
                'error' => 'Error al generar preview: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Preview directo (GET en navegador) — opcional para testing
     */
    public function previewDirect(Request $request)
    {
        // Para testing, usar páginas desde query params
        $pages = $request->query('pages', 'pagina1,pagina2,pagina3');
        if (is_string($pages)) {
            $pages = explode(',', $pages);
        }

        Log::info('🔍 Preview Direct - Testing', ['pages' => $pages]);

        // Simular request POST para reutilizar lógica
        $request->merge(['pages' => $pages]);
        
        return $this->preview($request);
    }
}