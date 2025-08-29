{{-- C:\laragon\www\contracts\resources\views\contracts\pagina26.blade.php --}}

<!-- ====== PÁGINA 26 - CONFIDENTIAL CONTACT INFORMATION NOTICE ====== -->
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
        opacity: 0.08;
        pointer-events: none;
    ">
        <img src="{{ $watermark64 }}" alt="Watermark" style="width: 1200px; height: auto;">
    </div>
    @endif

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 26 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2; min-height: calc(100vh - 120px); display: flex; flex-direction: column; justify-content: center;">
        
        <div style="
            background: transparent;
            padding: 40px 20px;
            max-width: 95%;
            margin: 0 auto;
        ">
            <h2 style="
                color: #dc2626;
                font-size: 1.8rem;
                font-weight: bold;
                margin-bottom: 30px;
                text-align: center;
                padding-bottom: 15px;
            ">Confidential Contact Information Notice</h2>

            <div style="
                font-size: 1rem;
                line-height: 1.7;
                color: #333;
                text-align: justify;
            ">
                <p style="margin-bottom: 25px;">
                    The contact information contained in this proposal is the <strong>proprietary and confidential information of Prime Facility Services Group Inc.</strong>, and is provided solely for the intended recipient.
                </p>

                <h3 style="
                    color: #162469ff;
                    font-size: 1.2rem;
                    font-weight: bold;
                    margin: 25px 0 15px 0;
                ">Non-Disclosure and Limited Use.</h3>
                <p style="margin-bottom: 25px;">
                    The recipient and their organization agree not to disclose, distribute, or share this confidential contact information with any third party—including but not limited to competitors, vendors, or other companies—without the prior written consent of Prime Facility Services Group Inc. Such information may only be shared or duplicated internally within the recipient's organization as necessary for legitimate business purposes.
                </p>

                <h3 style="
                    color: #162469ff;
                    font-size: 1.2rem;
                    font-weight: bold;
                    margin: 25px 0 15px 0;
                ">Liability for Breach.</h3>
                <p style="margin-bottom: 25px;">
                    The recipient and their company shall be <strong>fully liable and legally responsible</strong> for any unauthorized disclosure, distribution, or misuse of the confidential contact information, whether by them or their affiliates, employees, contractors, or representatives. This includes liability for any direct or indirect damages, legal expenses, or reputational harm suffered by Prime Facility Services Group Inc. as a result of such a breach.
                </p>

                <h3 style="
                    color: #162469ff;
                    font-size: 1.2rem;
                    font-weight: bold;
                    margin: 25px 0 15px 0;
                ">Return or Destruction.</h3>
                <p style="margin-bottom: 0;">
                    Upon request, the recipient agrees to promptly return or permanently destroy all copies (physical or digital) of the confidential contact information.
                </p>
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
</div>