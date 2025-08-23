{{-- C:\laragon\www\contracts\resources\views\contracts\pagina13.blade.php --}}

<!-- ====== PÁGINA 13  ====== -->
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
        
        <h3>Daily School Cafeteria & Dining Hall Cleaning Process</h3>
            <li>Trash Removal: Empty all bins, replace liners, and disinfect receptacles.</li>
            <li>High-Touch Surfaces: Disinfect tables, chairs, counters, door handles, and switches.</li>
            <li> Serving & Prep Areas: Wipe and disinfect counters, service lines, and food contact
surfaces.</li>
            <li> Floors: Sweep to remove debris and mop with neutral disinfectant solution.</li>
            <li>Restocking: Refill napkins, hand sanitizer, and other consumables as needed.</li>
            <li> Final Check: Ensure all areas are clean, dry, orderly, and ready for use.</li>               
        <ul>
            <li>Classrooms, offices, restrooms, hallways, sports areas, cafeteria, and other spaces agreed upon by the parties.</li>
        </ul>

        <h3>Service Standards</h3>
        <p>All services will be performed to the highest professional standards using environmentally friendly
cleaning products where possible. Prime Facility Services Group will ensure that all work is completed
during designated hours to minimize disruption to educational activities.
Regular quality inspections will be conducted to ensure compliance with agreed-upon standards. Any
issues or concerns will be addressed promptly and professionally.</p>

        <h3>Equipment and Supplies</h3>
        <p>Prime Facility Services Group will provide all necessary equipment, cleaning supplies, and materials
required to perform the services outlined in this scope of work. All equipment will be maintained in
good working condition and replaced as needed.</p>        


        <h3>Overage of Cleaning Supplies</h3>
        <p>If, due to emergencies, special occasions, Disinfection and Sanitization Services (such as those 
required during public health events like COVID-19), or other unscheduled circumstances, the 
performance of the Services requires cleaning chemicals, disinfectants, or related supplies in quantities 
beyond what is reasonably anticipated in the scope of this Agreement, the Contractor may charge the 
CLIENT for such excess usage. These additional costs will be invoiced at the Contractor’s 
actual acquisition cost plus a ten percent (10%) markup. The Contractor shall provide written notice 
to the CLIENT in advance of any such anticipated overage, and an itemized statement or 
supporting documentation of the costs will be made available to the CLIENT upon request.</p>
        
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