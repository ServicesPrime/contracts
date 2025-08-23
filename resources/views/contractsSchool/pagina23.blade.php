{{-- C:\laragon\www\contracts\resources\views\contracts\pagina23.blade.php --}}

<!-- ====== PÁGINA 23 - EXHIBIT B: BENEFITS WAIVER ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 23 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="exhibit-b-title">EXHIBIT B</h2>
        <h3 class="benefits-waiver-title">BENEFITS WAIVER FOR PRIME ASSOCIATES</h3>

        <p style="line-height: 1.4; margin-bottom: 30px;">
            <strong style="color: #b41f24;">Agreement and Waiver</strong><br>
            Considering assignment to CLIENT by PRIME, I agree that I am solely an employee of PRIME for benefits plan purposes and I am eligible only for such benefits as PRIME may offer me as its employee. I further understand and agree that I am not suitable for or entitled to participate or make any claim upon any benefit plan, policy, or practice offered by CLIENT, its parents, affiliates, subsidiaries, or successors to any point of assignment to CLIENT by PRIME, regardless of the length of my assignment, or CLIENT for any purpose; and therefore with full knowledge and understanding, at this moment expressly waive any claim or right that I may have, now or in the future, to such benefits and agree not to make any claim for such uses.
        </p>

        <table class="exhibit-b-signature-table">
            <tr>
                <td class="exhibit-b-signature-cell">
                    <strong style="color: #b41f24;">{{ $contract->client->address->name_account ?? 'CLIENT COMPANY' }}</strong>
                    <br><br><br><br>
                    <div class="exhibit-b-signature-line">
                    </div>
                    <div class="exhibit-b-signature-label">Signature</div>
                    <div class="exhibit-b-signature-line">
                    </div>
                    <div class="exhibit-b-signature-label">Printed Name</div>
                    <div class="exhibit-b-signature-line">
                    </div>
                    <div class="exhibit-b-signature-label">Date</div>
                </td>
                <td class="exhibit-b-signature-cell">
                    <strong style="color: #b41f24;">Prime Facility Services Group</strong>
                    <br><br><br><br>
                    <div class="exhibit-b-signature-line">
                    </div>
                    <div class="exhibit-b-signature-label">Signature</div>
                    <div class="exhibit-b-signature-line">
                    </div>
                    <div class="exhibit-b-signature-label">Printed Name</div>
                    <div class="exhibit-b-signature-line">
                    </div>
                    <div class="exhibit-b-signature-label">Title</div>
                    <div class="exhibit-b-signature-line">
                    </div>
                    <div class="exhibit-b-signature-label">Date</div>
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
<!-- ====== FIN PÁGINA 23 ====== -->