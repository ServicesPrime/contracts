
<div class="page">

<x-watermark />

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 22 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
            <div class="titulo">EXHIBIT (B)</div>
            <div class="titulo">BENEFITS WAIVER FOR PRIME ASSOCIATES</div>
      

            <div class="texto-normal" style="margin-bottom:15px; text-align: justify;">
                Considering assignment to CLIENT by PRIME, I agree that I am solely an employee of PRIME for
                benefits plan purposes and I am eligible only for such benefits as PRIME may offer me as its
                employee. I further understand and agree that I am not suitable for or entitled to participate or make
                any claim upon any benefit plan, policy, or practice offered by CLIENT, its parents, affiliates,
                subsidiaries, or successors to any point of assignment to CLIENT by PRIME, regardless of the length
                of my assignment, or CLIENT for any purpose; and therefore with full knowledge and understanding, at
                this moment expressly waive any claim or right that I may have, now or in the future, to such benefits
                and agree not to make any claim for such uses.
            </div>

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
<x-footer-pages />