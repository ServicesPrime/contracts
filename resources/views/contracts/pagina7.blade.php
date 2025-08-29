<div class="page">
@include('contracts.styles')
    <x-watermark />

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 7 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        
        <div class="subtitulo" style="margin: 18px 0 15px 0;">TERMS OF AGREEMENT</div>

        {{-- <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            The term of this Agreement shall be four (4) years from the date of execution by both parties. The
            Agreement may be terminated by either party with thirty (30) days’ prior written notice. This clause
            applies to all services described in the Agreement, except that, if either party becomes bankrupt,
            insolvent, discontinues operations, or fails to make payments as required, the other party may
            terminate the Agreement upon twenty-four (24) hours’ written notice.
        </div> --}}
        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
           The term of this Agreement shall be for the period specified in the Scope of Work, commencing on the date of execution by both parties.
            This Agreement may be terminated by either party upon written notice at least thirty (30) days in advance. This provision applies to all services described in the Agreement, except that if either party declares bankruptcy, becomes insolvent, discontinues operations, or fails to make the required payments, the other party may terminate it with twenty-four (24) hours’ written notice.
        </div>

        {{-- <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            Upon expiration of the initial term, this Agreement shall automatically renew for successive one (1)
            year periods unless either party provides written notice of non-renewal at least thirty (30) days prior to
            the renewal date. During any renewal period, the terms, conditions, and provisions of this Agreement
            shall remain in full force and effect unless modified in writing by mutual Agreement.
        </div> --}}
        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
           Applicable term options depending on the contracted service:
        </div>


        <div style="margin-left: 25px; margin-bottom: 14px;">
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">Single Service: valid only for the contracted service on the specified date.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">Defined Period: valid for a period of DEFINED_PERIOD months from the date of execution, renewable by mutual agreement.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">Recurring Services: in accordance with the service schedule set forth in the Scope of Work.</div>
        </div>

        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
           During any validity period, the terms and conditions of this Agreement shall remain in full force and effect, unless expressly modified in writing by the parties.
        </div>

        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            The authorized representatives of both parties execute this Agreement to confirm their acceptance of the terms set forth herein.
        </div>
        
        {{-- <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            The authorized representatives of the parties have executed this Agreement to confirm their
            acceptance of the terms set forth herein.
        </div> --}}

        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            The term of this Agreement shall be INITIAL_YEARS years from the date of execution by both parties.
        </div>
        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            This Agreement may be terminated by either party upon written notice at least thirty (30) days in advance. This clause applies to all services described in the Agreement, except that if either party declares bankruptcy, becomes insolvent, discontinues operations, or fails to make required payments, the other party may terminate it with twenty-four (24) hours’ written notice.
        </div>
        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            Upon expiration of the initial term, this Agreement shall automatically renew for successive one (1) year periods unless either party provides written notice of its intent not to renew at least thirty (30) days in advance.       
        </div>
        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            During any term or renewal period, the terms and conditions of this Agreement shall remain in full force and effect, unless expressly modified in writing by the parties.        
        </div>
        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
            The authorized representatives of both parties execute this Agreement to confirm their acceptance of the terms set forth herein.
        </div>

        <br><br>
<!-- Tabla de firmas -->
<table class="texto-normal" style="margin: 0 auto; text-align: center; width: 90%; border-collapse: collapse;">
    <tr>
        <!-- Columna Cliente -->
        <td class="signature-cell" style="padding: 20px; vertical-align: top; width: 50%;">
            <div class="subtitulo-sin" style="margin-bottom: 40px; text-align: center;">
                {{ $contract->client->address->name_account ?? 'CLIENT COMPANY' }}
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

<x-footer-pages />
