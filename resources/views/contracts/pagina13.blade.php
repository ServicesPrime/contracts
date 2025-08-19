{{-- C:\laragon\www\contracts\resources\views\contracts\pagina13.blade.php --}}

<!-- ====== PÁGINA 13 - TECHNICAL ANNEX ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 13 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">TECHNICAL ANNEX – SCOPE OF THE INITIAL DEEP CLEANING SERVICE</h2>

        <p>This annex aims to outline, as a reference, the areas, activities, and quality criteria recommended for carrying out the Initial Deep Cleaning Service, with the objective of reaching an optimal level of cleanliness that will serve as the basis for the regular service.</p>

        <h3>1. Areas included:</h3>
        <ul>
            <li>Classrooms, offices, restrooms, hallways, sports areas, cafeteria, and other spaces agreed upon by the parties.</li>
        </ul>

        <h3>2. Activities included:</h3>
        <ul>
            <li>Deep cleaning of floors, walls, and ceilings.</li>
            <li>Disinfection of restrooms, locker rooms, and common areas.</li>
            <li>Cleaning of accessible interior and exterior windows.</li>
            <li>Cleaning of fixed furniture and equipment.</li>
            <li>Removal of accumulated dust from high surfaces and accessible ducts.</li>
            <li>Cleaning and organizing folders/files.</li>
            <li>Cleaning and treatment of all types of floors.</li>
            <li>Power washing of exterior walkways and areas.</li>
            <li>Deep cleaning of all kitchens and vent hoods.</li>
        </ul>

        <h3>3. Activities not included (require separate quotation):</h3>
        <ul>
            <li>Work at height requiring scaffolding or harnesses.</li>
            <li>Polishing or crystallization of special floors.</li>
            <li>Cleaning of internal ventilation ducts.</li>
            <li>Painting, repairs, or renovations.</li>
        </ul>

        <h3>4. Completion standard:</h3>
        <p>All included areas must be free from visible dirt, unpleasant odors, and with surfaces clean to the touch, as verified by both parties.</p>
        
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
<!-- ====== FIN PÁGINA 13 ====== -->