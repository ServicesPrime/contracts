<div class="page">
    @include('contractsHospitality.styles')
    <x-watermarkhospitality />

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 7 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        
        <div class="subtitulo" style="margin: 18px 0 15px 0;">TERMS OF AGREEMENT</div>

        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            Terms of Agreement will be for 1 yr. from the first date both parties have executed it. The Agreement may be terminated by either party upon 30 days written notice. If either party becomes bankrupt or insolvent, discontinues operations, or fails to make payments as required, either party may terminate the agreement upon 24 hours written notice. Upon the expiration of any renewal term of this Agreement, the employment of Prime Associates shall be automatically renewed yearly unless, at least thirty (30) written notice days before the renewal date, either party gives the other party written notice of its intent not to continue the relationship. During any renewal term, this Agreement shall remain in effect unless modified.
        </div>


        <br><br>
<!-- Tabla de firmas -->
<table class="texto-normal" style="margin: 0 auto; text-align: center; width: 90%; border-collapse: collapse;">
    <tr>
        <!-- Columna Cliente -->
        <td class="signature-cell" style="padding: 20px; vertical-align: top; width: 50%;">
            <div class="subtitulo-sin" style="margin-bottom: 40px; text-align: center;">
                {{ $contract->client->address->name_account ?? $client->address->name_account ?? 'CLIENT COMPANY' }}
            </div>

            <div class="signature-block">
                <div class="signature-line" style="border-bottom: 1px solid #a00; margin: 30px 0;"></div>
                Signature
            </div>

            <div class="signature-block">
                <div class="signature-line" style="border-bottom: 1px solid #a00; margin: 30px 0;"></div>
                Printed Name
            </div>

            <div class="signature-block">
                <div class="signature-line" style="border-bottom: 1px solid #a00; margin: 30px 0;"></div>
                Title
            </div>

            <div class="signature-block">
                <div class="signature-line" style="border-bottom: 1px solid #a00; margin: 30px 0;"></div>
                Date
            </div>
        </td>

        <!-- Columna Prime -->
        <td class="signature-cell" style="padding: 20px; vertical-align: top; width: 50%;">
            <div class="subtitulo-sin" style="margin-bottom: 40px;">
                Prime Facility Services Group
            </div>

            <div class="signature-block">
                <div class="signature-line" style="border-bottom: 1px solid #a00; margin: 30px 0;"></div>
                Signature
            </div>

            <div class="signature-block">
                <div class="signature-line" style="border-bottom: 1px solid #a00; margin: 30px 0;"></div>
                Printed Name
            </div>

            <div class="signature-block">
                <div class="signature-line" style="border-bottom: 1px solid #a00; margin: 30px 0;"></div>
                Title
            </div>

            <div class="signature-block">
                <div class="signature-line" style="border-bottom: 1px solid #a00; margin: 30px 0;"></div>
                Date
            </div>
        </td>
    </tr>
</table>



        
    </div>
</div>

<x-footer-pages-hospitality />
