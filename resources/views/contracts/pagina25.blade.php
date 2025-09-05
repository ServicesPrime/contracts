
<div class="page">
    @include('contracts.styles')
    @php
    $pag4Path = storage_path('app/public/4.png');

    $pag4 = file_exists($pag4Path) 
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($pag4Path)) 
        : '';
@endphp
<x-watermark />

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 22 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        
            <div class="titulo">EXHIBIT (D)</div>

            @if($pag4)
            <div style="text-align: center; margin-top: 20px; position: relative;">
                <img src="{{ $pag4 }}" alt="Seguro" style="width: 105%; height: auto; position: relative; top: -15px; left: -10px;">
            </div>
            @endif

        
    </div>
</div>
<x-footer-pages />