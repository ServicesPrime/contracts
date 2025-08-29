{{-- C:\laragon\www\contracts\resources\views\contracts\pagina14.blade.php --}}

<!-- ====== PÁGINA 14 - SCOPE OF WORK ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 14 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">SERVICE SCOPE OF WORK / KITCHEN</h2>

        <p style="margin-bottom: 30px;">
            Prime Facility Services Group will provide comprehensive kitchen facility management services for all 
            designated kitchen areas within the Awty International School campus. The following services will be 
            performed according to the specified schedule and quality standards outlined in this agreement.
        </p>

        <h3>Daily Kitchen Services</h3>
        
        <h4 style="color: #b41f24; margin-bottom: 5px;">Trash Removal:</h4>
        <p style="margin-bottom: 10px; line-height: 1.3;">Empty all bins, replace liners, and disinfect receptacles.</p>

        <h4 style="color: #b41f24; margin-bottom: 5px;">High-Touch Surfaces:</h4>
        <p style="margin-bottom: 10px; line-height: 1.3;">Clean and disinfect counters, prep tables, handles, switches, and other frequently touched areas.</p>

        <h4 style="color: #b41f24; margin-bottom: 5px;">Equipment (External Only):</h4>
        <p style="margin-bottom: 10px; line-height: 1.3;">Wipe down and disinfect stoves, ovens, refrigerators, and stainless steel surfaces.</p>

        <h4 style="color: #b41f24; margin-bottom: 5px;">Sinks & Drains:</h4>
        <p style="margin-bottom: 10px; line-height: 1.3;">Clean and disinfect sinks; flush and inspect drains to ensure proper function.</p>

        <h4 style="color: #b41f24; margin-bottom: 5px;">Floors:</h4>
        <p style="margin-bottom: 10px; line-height: 1.3;">Sweep to remove debris and mop with a degreasing solution to maintain safety and hygiene.</p>

        <h4 style="color: #b41f24; margin-bottom: 5px;">Restocking:</h4>
        <p style="margin-bottom: 10px; line-height: 1.3;">Refill soap, paper towels, and sanitizing supplies as needed.</p>

        <h4 style="color: #b41f24; margin-bottom: 5px;">Final Check:</h4>
        <p style="margin-bottom: 10px; line-height: 1.3;">Confirm that the kitchen is clean, sanitized, and fully prepared for safe food preparation.</p>

        <h3>Additional Note</h3>
        <p style="margin-bottom: 15px; line-height: 1.3;">
            Hood vents and filters receive deep cleaning and degreasing every three (3) months as part of the 
            periodic maintenance program.
        </p>

        <h3>Service Standards</h3>
        <p style="margin-bottom: 10px; line-height: 1.3;">
            All cleaning services will be delivered to the highest professional standards, prioritizing the use of 
            environmentally friendly products where possible. Work will be completed during designated hours to 
            minimize disruption to educational activities. Regular quality inspections will be conducted to verify 
            compliance with agreed standards, and any concerns will be addressed promptly and professionally.
        </p>

        <h3>Equipment and Supplies</h3>
        <p style="line-height: 1.3;">
            Prime Facility Services Group will provide all required equipment, cleaning supplies, and materials. 
            All equipment will be maintained in good working condition and replaced as necessary.
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
<!-- ====== FIN PÁGINA 14 ====== -->