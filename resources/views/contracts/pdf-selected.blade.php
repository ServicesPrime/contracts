{{-- resources/views/contracts/pdf-selected.blade.php --}}

{{-- WRAPPER PRINCIPAL --}}
@php $isPreviewMode = !empty($isPreview); @endphp
<div class="{{ $isPreviewMode ? 'preview-mode' : 'print-mode' }}" data-mode="{{ $isPreviewMode ? 'preview' : 'print' }}">

    <div style="font-size:12px;color:#888;">[modo: {{ $isPreviewMode ? 'preview' : 'print' }} | isPreview={{ json_encode($isPreview) }}]</div>


@include('contracts.styles')

@php
    // ✅ Debug: Log de lo que llega a la vista
    Log::info('🎨 BLADE: Datos recibidos en pdf-selected.blade.php', [
        'selectedPages' => $selectedPages ?? 'NOT_SET',
        'selectedPages_type' => gettype($selectedPages ?? null),
        'selectedPages_count' => isset($selectedPages) ? count($selectedPages) : 0,
        'isPreview' => $isPreview ?? 'NOT_SET',
        'all_variables' => array_keys(get_defined_vars()),
    ]);

    // Mapeo completo de páginas disponibles
    $pageMap = [
        'cover'     => 'contracts.cover.janitorial.cover',
        'pagina00'  => 'contracts.pagina00',
        'pagina0'  => 'contracts.pagina0',
        'pagina1'   => 'contracts.pagina1',
        'pagina2'   => 'contracts.pagina2',
        'pagina3'   => 'contracts.pagina3',
        'pagina4'   => 'contracts.pagina4',
        'pagina5'   => 'contracts.pagina5',
        'pagina6'   => 'contracts.pagina6',
        'pagina7'   => 'contracts.pagina7',
        'pagina8'   => 'contracts.pagina8',
        'pagina9'   => 'contracts.pagina9',
        'pagina10'  => 'contracts.pagina10',
        'pagina11'  => 'contracts.pagina11',
        'pagina12'  => 'contracts.pagina12',
        'pagina13'  => 'contracts.pagina13',
        'pagina14'  => 'contracts.pagina14',
        'pagina16'  => 'contracts.pagina16',
        'pagina19'  => 'contracts.pagina19',
        'pagina20'  => 'contracts.pagina20',
        'pagina21'  => 'contracts.pagina21',
        'pagina22'  => 'contracts.pagina22',
        'pagina23'  => 'contracts.pagina23',
        'pagina24'  => 'contracts.pagina24',
        'pagina25'  => 'contracts.pagina25',
        'pagina26'  => 'contracts.pagina26',
    ];
    
    // Páginas que requieren assets (logo/bldg)
    $pagesWithAssets = ['cover', 'thankyou'];
    
    // Validar que selectedPages existe y no está vacío
    $pagesToRender = isset($selectedPages) && !empty($selectedPages) 
        ? $selectedPages 
        : ['pagina1']; // Fallback
        
    Log::info('📄 BLADE: Páginas a renderizar (antes de filtrar)', [
        'pagesToRender' => $pagesToRender
    ]);
        
    // Filtrar solo páginas válidas
    $validPages = array_filter($pagesToRender, function($page) use ($pageMap) {
        $isValid = array_key_exists($page, $pageMap);
        Log::info("🔍 BLADE: Validando página '$page'", ['valid' => $isValid]);
        return $isValid;
    });
    
    // Si no hay páginas válidas, usar fallback
    if (empty($validPages)) {
        $validPages = ['pagina1'];
        Log::warning('⚠️ BLADE: No hay páginas válidas, usando fallback');
    }

    Log::info('✅ BLADE: Páginas válidas finales', [
        'validPages' => $validPages,
        'count' => count($validPages)
    ]);
@endphp

@if(empty($validPages))
    <div style="padding: 2rem; text-align: center; color: #666; background: #fee2e2; border: 1px solid #fca5a5;">
        <h3>❌ No se encontraron páginas válidas para mostrar</h3>
        <p><strong>Páginas solicitadas:</strong> {{ json_encode($selectedPages ?? []) }}</p>
        <p><strong>Páginas disponibles:</strong> {{ implode(', ', array_keys($pageMap)) }}</p>
    </div>
@else
    {{-- Renderizar cada página válida --}}
    @foreach($validPages as $index => $page)
        @if(array_key_exists($page, $pageMap))
            @php
                $viewPath = $pageMap[$page];
                $needsAssets = in_array($page, $pagesWithAssets);
              
            @endphp
            
            {{-- Verificar que la vista existe antes de incluirla --}}
            @if(View::exists($viewPath))
                <div class="page-container" data-page="{{ $page }}" data-index="{{ $index }}">
                    {{-- Header de debug para cada página --}}
                    <div style="background: #ecfdf5; border-left: 4px solid #10b981; padding: 0.5rem; margin-bottom: 1rem; font-size: 11px;">
                        <strong>📄 Página {{ $index + 1 }}/{{ count($validPages) }}:</strong> {{ $page }} 
                        ({{ $viewPath }})
                    </div>
                    
                    @if($needsAssets)
                        @include($viewPath, [
                            'logo64' => $logo64 ?? '', 
                            'bldg64' => $bldg64 ?? ''
                        ])
                    @else
                        @include($viewPath)
                    @endif
                </div>
                
                {{-- Separador entre páginas (excepto la última) --}}
                @if(!$loop->last)
                    <div style="page-break-after: always; height: 2rem; background: linear-gradient(45deg, #f3f4f6 25%, transparent 25%), linear-gradient(-45deg, #f3f4f6 25%, transparent 25%); background-size: 20px 20px; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #6b7280;">
                        --- SEPARADOR DE PÁGINA ---
                    </div>
                @endif
            @else
                <div style="padding: 1rem; border: 2px solid #f59e0b; margin: 1rem 0; background: #fef3c7; color: #92400e;">
                    <strong>⚠️ Vista no encontrada:</strong> {{ $viewPath }} 
                    <br><small>Página solicitada: {{ $page }}</small>
                </div>
            @endif
        @else
            <div style="padding: 1rem; border: 2px solid #ef4444; margin: 1rem 0; background: #fee2e2; color: #dc2626;">
                <strong>❌ Página no mapeada:</strong> {{ $page }}
            </div>
        @endif
    @endforeach
@endif

{{-- CERRAR EL WRAPPER AQUÍ --}}
</div>

{{-- TUS ESTILOS ORIGINALES INTACTOS --}}
<style>
.page-container {
    position: relative;
    min-height: 50vh;
    margin-bottom: 2rem;
    border: 1px dashed #e5e7eb;
    padding: 1rem;
}

/* Información de debug en esquina superior derecha */
.page-container::after {
    content: "ID: " attr(data-page) " (#" attr(data-index) ")";
    position: absolute;
    top: 0.25rem;
    right: 0.25rem;
    font-size: 0.75rem;
    color: #9ca3af;
    background: rgba(255, 255, 255, 0.9);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    border: 1px solid #e5e7eb;
    z-index: 1000;
}
</style>