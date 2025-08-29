
<div class="page">
@include('contracts.styles')
<x-watermark />
    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 2 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        
       <div class="subtitulo" style="margin: 18px 0 15px 0;">Payment Terms, Bill Rates, and Fees</div>
        
        {{-- <div class="texto-normal" style="margin-bottom:15px;">2. Client will pay PRIME for the services delivered as outlined in Exhibit A, at the rates specified. PRIME will invoice CLIENT on a periodic basis (weekly, monthly, or as otherwise agreed) based on the completion of the tasks specified in the Scope of Work.</div>
        
        <div style="margin-left: 25px; margin-bottom: 14px;">
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">Payment is due within thirty (30) days from the date of the invoice. Invoices will be supported by the pertinent time sheets or other agreed systems for documenting time worked by Prime Associates. CLIENT's signature or other agreed method of approval of the work time submitted for Prime Associates certifies that the documented hours are correct and authorizes PRIME to bill CLIENT for those hours.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">While certain services under this Agreement are provided at a fixed price agreed upon by CLIENT and PRIME, CLIENT acknowledges that not all requested work falls under a single rate. Depending on the type of work required, some services may be billed on an hourly basis at the applicable rates mutually agreed by CLIENT and PRIME for each category of work. PRIME will issue invoices accordingly, specifying whether the charge relates to the fixed price Agreement or to hourly services performed.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">If a portion of any invoice is disputed, CLIENT shall timely pay the undisputed portion, while the parties resolve the disputed amount in good faith.</div>          
        </div> --}}
        
        <div class="texto-normal" style="margin-bottom:15px;">2. The CLIENT shall pay PRIME for the services rendered as indicated in the Scope of Work and in Annex A, at the fixed price agreed upon by the parties and specified in Annex A. PRIME shall invoice the CLIENT on a periodic basis (weekly, monthly, or as otherwise agreed) based on the completion of the tasks specified in the Scope of Work. Payment shall be made within thirty (30) days from the date of the invoice. The CLIENT’s signature or another mutually agreed method of approval shall certify that the services have been satisfactorily delivered and shall authorize PRIME to invoice the CLIENT for the agreed fixed price. If any portion of an invoice is disputed, the CLIENT shall promptly pay the undisputed portion while the parties, in good faith, resolve the disputed amount.</div>

        {{-- <div class="texto-normal" style="margin-bottom:15px;">3. Prime Associates are presumed to be nonexempt from laws requiring premium pay for overtime, holiday work, or weekend work. PRIME will charge CLIENT special rates for premium work time only when a Prime Associate's work on assignment to CLIENT, viewed by itself, would legally require premium pay and CLIENT has authorized, directed, or allowed the Prime Associate to work such premium work time. CLIENT's special billing rate for premium hours will be billed the exact multiple of the regular billing rate as PRIME is required to apply to the Prime Associate's standard pay rate. (For example, when federal law requires time ½ of pay for work exceeding 40 hours a week, CLIENT will be billed at time ½ plus the regular billing rate markup.)</div> --}}
        <div class="texto-normal" style="margin-bottom:15px;">3. The agreed fixed price covers all standard services outlined in the Scope of Work and in Annex A. Any additional services requested outside the scope of this agreement shall be quoted separately and shall require the prior written approval of both parties.</div>
        
        {{-- <div class="texto-normal" style="margin-bottom:15px;">4. In addition to the bill rates specified in Exhibit A of this agreement, CLIENT will pay PRIME the amount of all new or increased labor costs associated with CLIENT's Prime Associates that PRIME is legally required to pay—such as wages, benefits, payroll taxes, social program contributions, or charges linked to benefit levels—until the parties agree on new bill rates.</div> --}}
        <div class="texto-normal" style="margin-bottom:15px;">4. The CLIENT acknowledges and agrees that COMPANY_NAME shall charge applicable state taxes on all goods and services provided under this contract. The state tax rate and calculation method shall be in accordance with the applicable state tax laws and regulations in effect. The CLIENT shall be responsible for paying these state taxes in addition to the agreed fees for the contracted services. COMPANY_NAME shall provide the CLIENT with proper documentation and receipts for state tax charges. Any changes in state tax rates or regulations shall apply to orders accordingly.</div>
        
        {{-- <div class="texto-normal" style="margin-bottom:15px;">5. The Customer acknowledges and agrees that Prime Hospitality Services of Texas shall charge applicable state taxes on all goods and services provided under this contract. The rate of state taxes and the method of calculation shall be in accordance with the prevailing state tax laws and regulations. The Customer shall be responsible for paying these state taxes and the agreed-upon fees for the contracted services. Prime Hospitality Services of Texas shall provide the Customer with proper documentation and receipts for state tax charges. Any changes to state tax rates or regulations shall be applied to the orders accordingly.</div> --}}
        
</div>
</div>
<x-footer-pages />
<!-- ====== FIN PÁGINA 2 ====== -->