{{-- C:\laragon\www\contracts\resources\views\contracts\pagina12.blade.php --}}

<!-- ====== PÁGINA 12 - EXHIBIT C: CONFIDENTIALITY AGREEMENT ====== -->
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
        
        <h2 class="exhibit-c-title">EXHIBIT C</h2>
        <h3 class="confidentiality-title">CONFIDENTIALITY AGREEMENT FOR ASSIGNED EMPLOYEES</h3>

        <p><strong style="color: #b41f24;">Assigned Employee Confidentiality Agreement</strong></p>

        <p>As a condition of my assignment by PRIME to CLIENT, I at this moment agree as follows:</p>

        <ul>
            <li>I will not use, disclose, or in any way reveal or disseminate to unauthorized parties any information I gain through contact with materials or documents made available through my assignment at CLIENT or which I learn about during such assignment.</li>
            <li>I will not disclose, in any way, reveal or disseminate any information about CLIENT or its operating methods and procedures that come to my attention because of this assignment.</li>
            <li>Under no circumstances will I remove physical or electronic documents or copies of documents from CLIENT's premises.</li>
            <li>I understand that I will be responsible for any direct or consequential damages resulting from any violation of this Agreement.</li>
            <li>The obligations of this Agreement will survive my employment by PRIME.</li>
        </ul>

        <br><br>

        <table class="exhibit-c-signature-table">
            <tr>
                <td class="exhibit-c-signature-cell">
                    <strong style="color: #b41f24;">{{ $contract->client->address->name_account ?? 'CLIENT COMPANY' }}</strong>
                    <br><br><br><br>
                    <div class="exhibit-c-signature-line">
                    </div>
                    <div class="exhibit-c-signature-label">Signature</div>
                    <div class="exhibit-c-signature-line">
                    </div>
                    <div class="exhibit-c-signature-label">Printed Name</div>
                    <div class="exhibit-c-signature-line">
                    </div>
                    <div class="exhibit-c-signature-label">Title</div>
                    <div class="exhibit-c-signature-line">
                    </div>
                    <div class="exhibit-c-signature-label">Date</div>
                </td>
                <td class="exhibit-c-signature-cell">
                    <strong style="color: #b41f24;">Prime Facility Services Group</strong>
                    <br><br><br><br>
                    <div class="exhibit-c-signature-line">
                    </div>
                    <div class="exhibit-c-signature-label">Signature</div>
                    <div class="exhibit-c-signature-line">
                    </div>
                    <div class="exhibit-c-signature-label">Printed Name</div>
                    <div class="exhibit-c-signature-line">
                    </div>
                    <div class="exhibit-c-signature-label">Title</div>
                    <div class="exhibit-c-signature-line">
                    </div>
                    <div class="exhibit-c-signature-label">Date</div>
                </td>
            </tr>
        </table>
        
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