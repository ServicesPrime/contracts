<div class="page">
@php
    $catalogo1Path = storage_path('app/public/catalogo2.png');

    $catalogo1 = file_exists($catalogo1Path) 
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($catalogo1Path)) 
        : '';
@endphp

<x-watermark />
<!-- Número de página -->
<div class="page-number">{{ $pageNumber ?? 20 }}</div>

<div class="content-padding" style="position: relative; z-index: 2;">
    <div class="titulo">
        {{ $contract->client->address->name_account ?? $client->address->name_account ?? '' }} Recommended Chemicals
    </div>
    
    @if($catalogo1)
    <div style="text-align: center; margin-top: 5px; position: relative;">
        <img src="{{ $catalogo1 }}" alt="Seguro" style="width: 105%; height: auto; position: relative; top: -15px; left: -10px;">
    </div>
    @endif

</div>
</div>

<x-footer-pages />
