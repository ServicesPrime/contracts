{{-- C:\laragon\www\contracts\resources\views\contracts\pagina7.blade.php --}}

<!-- ====== PÁGINA 7 - TERMS OF AGREEMENT ====== -->
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
        
        <h2 class="terms-title">TERMS OF AGREEMENT</h2>

        <p>
            Terms of Agreement will be for 1 year from the first date both parties have executed it.
            The Agreement may be terminated by either party upon 30 days written notice.
            This clause applies to all services described in the Agreement, except if a party becomes bankrupt or insolvent,
            discontinues operations, or fails to make payments as required; either party may terminate the agreement upon 24 hours written notice.
        </p>

        <p>
            Upon the expiration of the original term or any renewal term of employment, Employee's work shall be automatically renewed yearly unless,
            at least thirty (30) written notice days before the renewal date, either party gives the other party written notice of its intent not to continue the employment relationship.
            During any renewal term of employment, the terms, conditions, and provisions outlined in this Agreement shall remain in effect unless modified.
        </p>

        <p>
            Authorized parties' representatives have executed this Agreement below to express the parties' agreement to its terms.
        </p>

        <br><br>

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
<!-- ====== FIN PÁGINA 7 ====== -->