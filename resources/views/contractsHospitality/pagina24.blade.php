
<div class="page">
    @include('contracts.styles')
<x-watermark />

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 22 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        
            <div class="titulo">EXHIBIT (C)</div>
            <div class="titulo">CONFIDENTIALITY AGREEMENT FOR ASSIGNED EMPLOYEES</div>
            <br>

            <div class="texto-normal">
                As a condition of my assignment by PRIME to CLIENT, I at this moment agree as follows:
            
                    <ul style="list-style-type: disc; margin-left: 20px; line-height: 1.6;">
                      
                            <li>I will not use, disclose, or in any way reveal or disseminate to unauthorized parties any information</li>
                            <li>I gain through contact with materials or documents made available through my assignment at CLIENT, or which I learn about during such assignment.</li>
                            <li>I will not disclose, in any way reveal or disseminate my information about CLIENT or its operating methods and procedures that come to my attention because of this assignment.</li>
                            <li>I will remove physical or electronic documents or copies of documents from CLIENT’s premises.</li>
                            <li>I understand that I will be responsible for any direct or consequential damages resulting from any violation of this Agreement.</li>

                    </ul>
                

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