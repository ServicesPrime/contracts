
<div class="page">
<x-watermark />
    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 16 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        

          <div class="titulo">SUGGESTED INITIAL DEEP CLEANING SERVICE CLAUSE</div>

        <br>
        <div class="texto-normal">
          To ensure that the CLIENT begins the contracted services with facilities already set at an optimal standard, 
            PRIME suggests the implementation of a one-time Initial Deep Cleaning Service prior to the start of regular 
            maintenance. This proactive step is intended to leave the premises in an enhanced hygienic and operational 
            condition, making it easier for the assigned permanent staff to consistently maintain such standards 
            throughout the ongoing service.
        </div>
        <br>
        <div class="texto-normal">
            The Initial Deep Cleaning Service would be carried out once, over an estimated period of up to thirty (30) 
            calendar days from the agreed start date. It will include more detailed tasks than the standard routine, 
            the use of specialized equipment and products, and, if required, additional staff to accomplish the 
            established objectives.
        </div>
        <br>
        <div class="texto-normal">
           For CLIENT's convenience, the cost of this Initial Deep Cleaning Service will be separately agreed, with 
            the option to pay in six (6) consecutive monthly installments, without interest, beginning upon issuance 
            of the corresponding invoice.
        </div>
        <br>
        <div class="texto-normal">
           Should circumstances beyond PRIME's control arise—such as construction work, change of use, or any 
            extraordinary conditions requiring additional interventions beyond this Initial Service—these will be 
            quoted separately and executed only upon CLIENT's prior written approval.
        </div>
        <br>
  
       
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