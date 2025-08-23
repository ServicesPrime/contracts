{{-- C:\laragon\www\contracts\resources\views\contracts\pagina16.blade.php --}}

<!-- ====== PÁGINA 16 - INITIAL DEEP CLEANING SERVICE ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 16 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="terms-title">SUGGESTED INITIAL DEEP CLEANING SERVICE CLAUSE</h2>

        <p style="line-height: 1.4; margin-bottom: 20px;">
            To ensure that the CLIENT begins the contracted services with facilities already set at an optimal standard, 
            PRIME suggests the implementation of a one-time Initial Deep Cleaning Service prior to the start of regular 
            maintenance. This proactive step is intended to leave the premises in an enhanced hygienic and operational 
            condition, making it easier for the assigned permanent staff to consistently maintain such standards 
            throughout the ongoing service.
        </p>

        <p style="line-height: 1.4; margin-bottom: 20px;">
            The Initial Deep Cleaning Service would be carried out once, over an estimated period of up to thirty (30) 
            calendar days from the agreed start date. It will include more detailed tasks than the standard routine, 
            the use of specialized equipment and products, and, if required, additional staff to accomplish the 
            established objectives.
        </p>

        <p style="line-height: 1.4; margin-bottom: 20px;">
            For CLIENT's convenience, the cost of this Initial Deep Cleaning Service will be separately agreed, with 
            the option to pay in six (6) consecutive monthly installments, without interest, beginning upon issuance 
            of the corresponding invoice.
        </p>

        <p style="line-height: 1.4; margin-bottom: 30px;">
            Should circumstances beyond PRIME's control arise—such as construction work, change of use, or any 
            extraordinary conditions requiring additional interventions beyond this Initial Service—these will be 
            quoted separately and executed only upon CLIENT's prior written approval.
        </p>

        <table style="width: 100%; margin-bottom: 30px; border-collapse: collapse;">
            <tr>
                <td style="border: 2px solid #b41f24; padding: 10px; background-color: transparent; color: #1f4b96; font-weight: bold; text-align: center;">Labor Cost</td>
                <td style="border: 2px solid #b41f24; padding: 10px; background-color: transparent; color: #1f4b96; font-weight: bold; text-align: center;">Chemicals</td>
                <td style="border: 2px solid #b41f24; padding: 10px; background-color: transparent; color: #1f4b96; font-weight: bold; text-align: center;">Total</td>
                <td style="border: 2px solid #b41f24; padding: 10px; background-color: transparent; color: #1f4b96; font-weight: bold; text-align: center;">Monthly for a period of six months</td>
            </tr>
            <tr>
                <td style="border: 2px solid #b41f24; padding: 10px; background-color: transparent; color: #1f4b96; font-weight: bold; text-align: center;">$25,200</td>
                <td style="border: 2px solid #b41f24; padding: 10px; background-color: transparent; color: #1f4b96; font-weight: bold; text-align: center;">$7,500</td>
                <td style="border: 2px solid #b41f24; padding: 10px; background-color: transparent; color: #1f4b96; font-weight: bold; text-align: center;">$32,700</td>
                <td style="border: 2px solid #b41f24; padding: 10px; background-color: transparent; color: #1f4b96; font-weight: bold; text-align: center;">$5,450</td>
            </tr>
        </table>

        <table class="signature-table">
            <tr>
                <td class="signature-cell">
                    <strong>{{ $contract->client->address->name_account ?? 'CLIENT COMPANY' }}</strong>
                    <br><br><br><br>
                    <div class="signature-line">
                    </div>
                    <div class="signature-label">Signature</div>
                    <div class="signature-line">
                    </div>
                    <div class="signature-label">Printed Name</div>
                    <div class="signature-line">
                    </div>
                    <div class="signature-label">Title</div>
                    <div class="signature-line">
                    </div>
                    <div class="signature-label">Date</div>
                </td>
                <td class="signature-cell">
                    <strong>Prime Facility Services Group</strong>
                    <br><br><br><br>
                    <div class="signature-line">
                    </div>
                    <div class="signature-label">Signature</div>
                    <div class="signature-line">
                    </div>
                    <div class="signature-label">Printed Name</div>
                    <div class="signature-line">
                    </div>
                    <div class="signature-label">Title</div>
                    <div class="signature-line">
                    </div>
                    <div class="signature-label">Date</div>
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
<!-- ====== FIN PÁGINA 16 ====== -->