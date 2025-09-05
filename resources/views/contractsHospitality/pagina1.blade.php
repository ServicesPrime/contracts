{{-- resources/views/contracts/pagina1.blade.php --}}

<div class="page">
@include('contractsHospitality.styles')
<x-watermarkhospitality />
 <div class="page-number">{{ $pageNumber ?? 1 }}</div>
<div class="content-padding" style="position: relative; z-index: 2;">
        <div class="titulo">GENERAL TEMPORARY SERVICES AGREEMENT</div>
        
        <div class="texto-normal" style="margin-bottom:18px; text-align: justify;">
            PRIME FACILITY SERVICES OF TEXAS, with its principal office located at 8303 Westglen Dr, TX 77063 ("PRIME"), and  {{ $contract->client->address->name_account ?? $client->address->name_account ?? 'CLIENT COMPANY'}}, with its principal office located at "{{ $contract->client->address->full_address ?? $client->address->full_address ?? '100 Convention Center Way Baytown,TX, 77520' }}" ("CLIENT") agree to the terms and conditions outlined in this Staffing Agreement (the "Agreement").
        </div>
        
        <div class="subtitulo" style="text-align: left; margin: 18px 0 15px 0;">Prime Hospitality Services of Texas (Prime) Duties and Responsibilities</div>
        
        <div class="texto-normal" style="margin-bottom:15px;">1. Prime will:</div>
        
        <div style="margin-left: 25px; margin-bottom: 14px;">
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">a. Recruit, screen, interview, and assign its employees (Prime Associates) to perform the type of work described in Exhibit A under CLIENT’s supervision at the locations specified in Exhibit A.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">b. Pay Prime Associates’ wages and provide them with the benefits Prime offers them.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">c. Pay; provide unemployment insurance and workers’ compensation benefits and handle unemployment and workers’ compensation claims involving Prime Associates.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">d. Require Prime Associates to sign confidentiality agreements (in the form of Exhibit C) before they begin their assignments to CLIENT.</div>
        </div>
        
        <div class="subtitulo" style="text-align: left; margin: 18px 0 15px 0;">CLIENT's Duties and Responsibilities</div>
        
        <div class="texto-normal" style="margin-bottom:15px;">Client will:</div>
        
        <div style="margin-left: 25px; margin-bottom: 14px;">
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">1. Properly supervise Prime Associates performing its work and be responsible for its business operations, products, services, and intellectual property.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">e. Properly supervise, control, and safeguard its premises, processes, and systems, or entrust them with unattended premises, cash, credit cards, merchandise, confidential or trade secret information, keys, negotiable instruments, or other valuables without PRIME’s express prior written approval or strictly required by the job description provided to PRIME.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">f. Provide Prime Associates with a safe work site and appropriate information, training, and safety equipment concerning any hazardous substances or conditions that may be exposed at the work site.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">g. Not change Prime Associates' job duties without PRIME's express prior written approval.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">h. Provide Prime Associates with all equipment, supplies, and tools to perform daily tasks as scheduled by the CLIENT.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">i. Exclude Prime Associates from CLIENT’s benefit plans, policies, and practices, and do not make any offer or promise relating to Prime.</div>
        </div>
    </div>

<x-footer-pages-hospitality />
</div>