{{-- C:\laragon\www\contracts\resources\views\contracts\pagina8.blade.php --}}

<!-- ====== PÁGINA 8 - SERVICE AREAS & SCOPE OF WORK ====== -->
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
<div class="page-number">{{ $pageNumber ?? 8 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">SERVICE AREAS & SCOPE OF WORK</h2>

        <h3>Service Areas:</h3>
        <ul>
            <li>Main Kitchen</li>
        </ul>

        <h3>Scope of Work</h3>
        <p><span style="color: #b41f24; font-weight: normal;">Frequency: Monthly, 7 days per week</span></p>

        <ul>
            <li>Thorough cleaning of all kitchen surfaces, ensuring removal of grease, food residues, and buildup in hard-to-reach areas.</li>
        </ul>

        <h3>Equipment:</h3>
        <ul>
            <li>Clean all kitchen appliances and equipment (exterior surfaces, control panels, and access areas).</li>
            <li>Remove accumulated grease and debris from behind and underneath appliances where accessible.</li>
        </ul>

        <h3>Floors:</h3>
        <ul>
            <li>Sweep and mop all floor surfaces.</li>
            <li>Apply an intensive degreasing treatment to remove stubborn residues.</li>
        </ul>

        <h3>Walls & Ceilings:</h3>
        <ul>
            <li>Wipe down and degrease walls and ceilings in food preparation and cooking areas.</li>
            <li>Remove stains and dust to maintain a clean and sanitary environment.</li>
        </ul>
        
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