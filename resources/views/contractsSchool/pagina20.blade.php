{{-- C:\laragon\www\contracts\resources\views\contracts\pagina19.blade.php --}}

<!-- ====== PÁGINA 20 - ADDITIONAL STAFF SERVICES ====== -->
<div class="page">
@php
$watermarkPath = storage_path('app/public/Prime.png');
$watermark64 = file_exists($watermarkPath)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($watermarkPath))
    : '';

$catalogo1Path = storage_path('app/public/limpieza2.png');
$catalogo64 = file_exists($catalogo1Path)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($catalogo1Path))
    : '';
@endphp

    <!-- Marca de agua de fondo -->
    @if($watermark64)
    <div style="
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        opacity: 0.05;
        pointer-events: none;
    ">
        <img src="{{ $watermark64 }}" alt="Watermark" style="width: 1200px; height: auto;">
    </div>
    @endif

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 20 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">Awty International School Recommended Chemicals</h2>
        
        @if($catalogo64)
        <div style="text-align: center; margin-top: 5px; position: relative;">
            <img src="{{ $catalogo64 }}" alt="Seguro" style="width: 105%; height: auto; position: relative; top: -35px; left: -10px;">
        </div>
        @endif
    
    </div>
</div>

<!-- Footer fijo global -->
<div class="footer">
    <div class="site-footer">
        <div class="footer-red"></div>
        <div class="footer-blue">
            8303 Westglen Dr ~ Houston, TX 77063 ~ Phone 713-338-2553 ~ Fax 713-574-3065<br>
            www.primefacilityservicesgroup.com
        </div>
    </div>
</div>
<!-- ====== FIN PÁGINA 20 ====== -->