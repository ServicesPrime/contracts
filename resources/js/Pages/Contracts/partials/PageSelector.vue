{{-- resources/views/contracts/pdf-selected.blade.php --}}

@include('contracts.styles')

@php
    // Mapeo de páginas disponibles
    $pageMap = [
        'cover'     => 'contracts.cover.janitorial.cover',
        'thankyou'  => 'contracts.thankyou',
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
        'pagina16'  => 'contracts.pagina16',
        'pagina19'  => 'contracts.pagina19',
        'pagina20'  => 'contracts.pagina20',
    ];
    
    // Páginas que requieren assets
    $pagesWithAssets = ['cover', 'thankyou'];
    
    // Validar páginas
    $pagesToRender = isset($selectedPages) && !empty($selectedPages) 
        ? $selectedPages 
        : ['pagina1'];
        
    // Filtrar páginas válidas
    $validPages = array_filter($pagesToRender, function($page) use ($pageMap) {
        return array_key_exists($page, $pageMap);
    });
    
    // Fallback si no hay páginas válidas
    if (empty($validPages)) {
        $validPages = ['pagina1'];
    }
@endphp

@if(empty($validPages))
    <div style="padding: 2rem; text-align: center; color: #666;">
        <h3>No se encontraron páginas válidas para mostrar</h3>
    </div>
@else
    {{-- Renderizar cada página válida --}}
    @foreach($validPages as $page)
        @if(array_key_exists($page, $pageMap))
            @php
                $viewPath = $pageMap[$page];
                $needsAssets = in_array($page, $pagesWithAssets);
            @endphp
            
            {{-- Verificar que la vista existe --}}
            @if(View::exists($viewPath))
                <div class="page-container">
                    @if($needsAssets)
                        @include($viewPath, [
                            'logo64' => $logo64 ?? '', 
                            'bldg64' => $bldg64 ?? ''
                        ])
                    @else
                        @include($viewPath)
                    @endif
                </div>
                
                {{-- Separador entre páginas --}}
                @if(!$loop->last)
                    <div style="page-break-after: always;"></div>
                @endif
            @else
                <div style="padding: 1rem; border: 1px solid #f59e0b; margin: 1rem 0; background: #fef3c7; color: #92400e;">
                    <strong>Vista no encontrada:</strong> {{ $viewPath }}
                </div>
            @endif
        @endif
    @endforeach
@endif

<style>
.page-container {
    position: relative;
    min-height: 100vh;
    margin-bottom: 2rem;
}
</style>