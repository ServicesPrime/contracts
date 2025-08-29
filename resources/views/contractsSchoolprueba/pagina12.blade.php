{{-- C:\laragon\www\contracts\resources\views\contracts\pagina12.blade.php --}}

<!-- ====== PÁGINA 12 - SCOPE OF WORK ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 12 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">SERVICE SCOPE OF WORK / SCHOOL</h2>

        <p style="margin-bottom: 30px;">
            Prime Facility Services Group will provide comprehensive facility management services for all designated areas 
            within the Awty International School campus. The following services will be performed according to the 
            specified schedule and quality standards outlined in this agreement.
        </p>

        <h3>Daily Services 5 Days a week Monday - Friday</h3>
        <h3>Daily Classroom Cleaning Process</h3>
        <ul style="margin-bottom: 25px;">
            <li>Trash Removal: Empty bins, replace liners, and disinfect.</li>
            <li>High-Touch Surfaces: Disinfect desks, chairs, handles, and switches.</li>
            <li>Board/Surfaces: Clean whiteboards and shared equipment.</li>
            <li>Carpeted Areas: Vacuum and spot-clean stains.</li>
            <li> BCT/Vinyl Floors: Sweep and damp mop with neutral cleaner.</li>
            <li>Final Check: Ensure room is orderly, clean, and ready for use.</li>            
        </ul>

        <h3>Daily School Restroom Cleaning Process</h3>
        <ul style="margin-bottom: 25px;">
            <li> Trash Removal: Empty bins, replace liners, and disinfect receptacles</li>
            <li>High-Touch Surfaces: Disinfect handles, switches, dispensers, and faucets.</li>
            <li> Toilets & Urinals: Clean and disinfect bowls, seats, and exterior surfaces.</li>
            <li> Sinks & Counters: Clean and disinfect sinks, faucets, and counters</li>
            <li>Mirrors & Glass: Clean to remove spots and streaks</li>
            <li> Restocking: Refill soap, paper towels, and toilet paper.(Customer Provided)</li>       
            <li> Floors: Sweep and mop with disinfectant</li>
            <li>Final Check: Ensure restroom is clean, dry, and ready for use.</li>                      
        </ul>

        <h3>Daily School Gymnasium Cleaning Process</h3>
        <ul style="margin-bottom: 25px;">
            <li>Trash Removal: Empty bins, replace liners, and disinfect receptacles.</li>
            <li> High-Touch Surfaces: Disinfect door handles, railings, bleachers, and shared surfaces.</li>
            <li>  Sports Floors: Dust mop or sweep to remove debris; spot-clean spills; damp mop with neutral
cleaner if needed.</li>
            <li> Locker Rooms / Restrooms: Clean and disinfect toilets, urinals, sinks, benches, and showers,
restock supplies, sweep and mop floors with disinfectant.</li>
            <li>Final Check: Ensure gym and locker areas are clean, dry, and safe for use.</li>
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
<!-- ====== FIN PÁGINA 12 ====== -->

