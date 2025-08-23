{{-- C:\laragon\www\contracts\resources\views\contracts\pagina15.blade.php --}}

<!-- ====== PÁGINA 15 - CONTINUACIÓN ====== -->
<div class="page">
@php
$watermarkPath = storage_path('app/public/Prime.png');
$watermark64 = file_exists($watermarkPath)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($watermarkPath))
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
    <div class="page-number">{{ $pageNumber ?? 15 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h3>Service Standards</h3>
        <p style="line-height: 1.4; margin-bottom: 30px;">
            All services will be performed to the highest professional standards using environmentally friendly 
            cleaning products where possible. Prime Facility Services Group will ensure that all work is completed 
            during designated hours to minimize disruption to educational activities. Regular quality inspections 
            will be conducted to ensure compliance with agreed-upon standards. Any issues or concerns will be 
            addressed promptly and professionally.
        </p>

        <h3>Equipment and Supplies</h3>
        <p style="line-height: 1.4;">
            Prime Facility Services Group will provide all necessary equipment, cleaning supplies, and materials 
            required to perform the services outlined in this scope of work. All equipment will be maintained in 
            good working condition and replaced as needed.
        </p>
        
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
<!-- ====== FIN PÁGINA 15 ====== -->