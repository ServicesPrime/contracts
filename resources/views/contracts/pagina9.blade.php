<!-- ====== PÁGINA 9 - INITIAL DEEP CLEANING SERVICE ====== -->
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
<div class="page-number">{{ $pageNumber ?? 9 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">CLAUSE – INITIAL DEEP CLEANING SERVICE</h2>

        <p>To promote a more efficient and mutually beneficial provision of services, <strong>PRIME</strong> recommends performing an Initial Deep Cleaning Service at the <strong>CLIENT's</strong> premises. The purpose of this service is to prepare the areas and bring them to an optimal level of cleanliness and hygiene, from which the assigned permanent staff can maintain such conditions through the regular contracted service.</p>

        <p>It is proposed that the Initial Deep Cleaning Service be a one-time service, conducted prior to the start of regular maintenance, with an estimated duration of up to <strong>forty-five (45) calendar days</strong> from the start date of the intervention.</p>

        <p>This cleaning would involve intensive tasks, the use of specialized equipment and products, as well as any additional personnel PRIME deems necessary to meet the established objectives.</p>

        <p>The cost of the Initial Deep Cleaning Service shall be agreed separately from the value of the regular service, with the option for the CLIENT to pay in <strong>six (6) consecutive monthly installments, without interest</strong>, starting from the date of issuance of the first corresponding invoice.</p>

        <p>If, for reasons beyond PRIME's control, the condition of the premises requires additional extraordinary interventions after the initial cleaning (due to events, construction works, change of use, etc.), these will be quoted and must be approved in writing before execution.</p>
        
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