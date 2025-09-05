
<div class="page">
    @include('contracts.styles')
    @php
    $pag4Path = storage_path('app/public/4.png');

    $pag4 = file_exists($pag4Path) 
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($pag4Path)) 
        : '';
@endphp
<x-watermark />

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 22 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        
            <div class="titulo">CONFIDENTIAL CONTACT INFORMATION NOTICE</div>
            <br>
            <div class="texto-normal">
                The contact information contained in this proposal is the proprietary and confidential information of Prime Facility Services Group Inc., and is provided solely for the intended recipient.
            </div>
            <br>
            <div class="subtitulo">Non-Disclosure and Limited Use.</div>
            <br>
            <div class="texto-normal">
                The recipient and their organization agree not to disclose, distribute, or share this confidential contact information with any third party—including but not limited to competitors, vendors, or other companies—without the prior written consent of Prime Facility Services Group Inc. Such information may only be shared or duplicated internally within the recipient’s organization as necessary for legitimate business purposes.
            </div>
            <br>
            <div class="subtitulo">Liability for Breach.</div>
            <br>
            <div class="texto-normal">
                The recipient and their company shall be fully liable and legally responsible for any unauthorized disclosure, distribution, or misuse of the confidential contact information, whether by them or their affiliates, employees, contractors, or representatives. This includes liability for any direct or indirect damages, legal expenses, or reputational harm suffered by Prime Facility Services Group Inc. as a result of such a breach.
            </div>
            <br>
            <div class="subtitulo">Return or Destruction.</div>
            <br>
            <div class="texto-normal">
                Upon request, the recipient agrees to promptly return or permanently destroy all copies (physical or digital) of the confidential contact information.
            </div>

        
    </div>
</div>
<x-footer-pages />