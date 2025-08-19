{{-- C:\laragon\www\contracts\resources\views\contracts\pagina1.blade.php --}}

<!-- ====== PÁGINA 1 ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 1 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        <h1>GENERAL TEMPORARY SERVICES AGREEMENT</h1>
        
        <p>
            PRIME FACILITY SERVICES GROUP, with its principal office located at 8303 Westglen Dr, TX 77063 ("PRIME"), and  {{ $contract->client->address->name_account ?? 'CLIENT COMPANY'}}, with its principal office located at "{{ $contract->client->address->full_address ?? '100 Convention Center Way Baytown,TX, 77520' }}" ("CLIENT") agree to the terms and conditions outlined in this Staffing Agreement (the "Agreement").
        </p>
        
        <h2>Prime Facility Services Group (Prime) Duties and Responsibilities</h2>
        
        <p class="numbered-item">1. Prime will:</p>
        
        <div class="sub-list">
            <p class="sub-item">a. Deliver the facility management services described in Exhibit A at the locations specified, ensuring that all tasks are completed to the highest standards and in accordance with industry best practices.</p>
            <p class="sub-item">b. Pay Prime Associates' wages and provide them with the benefits Prime offers them.</p>
            <p class="sub-item">c. Provide unemployment insurance and workers' compensation benefits and handle unemployment and workers' compensation claims involving Prime Associates.</p>
            <p class="sub-item">d. Require Prime Associates to sign confidentiality agreements (in the form of Exhibit C) before they begin their assignments to CLIENT.</p>
        </div>
        
        <h2>CLIENT's Duties and Responsibilities</h2>
        
        <p class="numbered-item">Client will:</p>
        
        <div class="sub-list">
            <p class="sub-item">1. Properly manage and supervise the delivery of services, ensuring that all operations, products, and procedures meet the agreed-upon standards.</p>
            <p class="sub-item">e. Properly supervise, control, and safeguard its premises, processes, and systems, or entrust them with unattended premises, cash, credit cards, merchandise, confidential or trade secret information, keys, negotiable instruments, or other valuables without PRIME's express prior written approval or strictly required by the job description provided to PRIME.</p>
            <p class="sub-item">f. Provide Prime Associates with a safe work site and appropriate information, training, and safety equipment concerning any hazardous substances or conditions that may be exposed at the work site.</p>
            <p class="sub-item">g. Not change Prime Associates' job duties without PRIME's express prior written approval.</p>
            <p class="sub-item">h. Provide access to the facility and any necessary site-specific information or resources required for the proper execution of the services described in Exhibit A.</p>
            <p class="sub-item">i. Exclude Prime Associates from CLIENT's benefit plans, policies, and practices, and do not make any offer or promise relating to Prime.</p>
        </div>
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
<!-- ====== FIN PÁGINA 1 ====== -->