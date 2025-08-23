<div class="page">
@php
$watermarkPath = storage_path('app/public/Prime.png');
$watermark64 = file_exists($watermarkPath)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($watermarkPath))
    : '';

$seguroPath = storage_path('app/public/seguro.png');
$seguro64 = file_exists($seguroPath)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($seguroPath))
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

    <!-- Contenido de la página -->
    <div style="position: relative; z-index: 2; padding: 40px 60px; text-align: center;">
        <!-- Encabezado principal -->
        <h1 style="
            color: #b41f24;
            font-size: 32px;
            font-weight: bold;
            margin: 0 0 20px 0;
            letter-spacing: 1px;
        ">EXHIBIT D</h1>

        <!-- Imagen centrada -->
       <!-- Imagen centrada -->
@if($seguro64)
<div style="text-align: center; margin-top: 20px;">
    <img src="{{ $seguro64 }}" alt="Seguro" style="width: 90%; height: auto;">
</div>
@endif

    </div>

    <div class="page-number">{{ $pageNumber ?? 25 }}</div>
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
