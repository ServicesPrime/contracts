{{-- C:\laragon\www\contracts\resources\views\contracts\pagina9.blade.php --}}

<!-- ====== PÁGINA 9 - EXHIBIT A / OVERNIGHT KITCHEN CLEANING ====== -->
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

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h3 class="exhibit-title">EXHIBIT A</h3>
        
        <h2 class="overnight-cleaning-title">OVERNIGHT KITCHEN CLEANING</h2>

        <h2 class="fees-title">FEES, PLUS TAXES</h2>

        <table class="pricing-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Frequency</th>
                    <th>Bill Rate (Monthly)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kitchen Cleaning 7 days per week (Main Kitchen)</td>
                    <td>Monthly</td>
                    <td>$6,089.56</td>
                </tr>
            </tbody>
        </table>

        <table class="exhibit-signature-table">
            <tr>
                <td class="exhibit-signature-cell">
                    <strong>{{ $contract->client->address->name_account ?? 'CLIENT COMPANY' }}</strong>
                    <br><br><br><br>
                    <div class="exhibit-signature-line">
                    </div>
                    <div class="exhibit-signature-label">Signature</div>
                    <div class="exhibit-signature-line">
                    </div>
                    <div class="exhibit-signature-label">Printed Name</div>
                    <div class="exhibit-signature-line">
                    </div>
                    <div class="exhibit-signature-label">Title</div>
                    <div class="exhibit-signature-line">
                    </div>
                    <div class="exhibit-signature-label">Date</div>
                </td>
                <td class="exhibit-signature-cell">
                    <strong>Prime Facility Services Group</strong>
                    <br><br><br><br>
                    <div class="exhibit-signature-line">
                    </div>
                    <div class="exhibit-signature-label">Signature</div>
                    <div class="exhibit-signature-line">
                    </div>
                    <div class="exhibit-signature-label">Printed Name</div>
                    <div class="exhibit-signature-line">
                    </div>
                    <div class="exhibit-signature-label">Title</div>
                    <div class="exhibit-signature-line">
                    </div>
                    <div class="exhibit-signature-label">Date</div>
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
<!-- ====== FIN PÁGINA 9 ====== -->