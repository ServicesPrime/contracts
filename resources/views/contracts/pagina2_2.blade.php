{{-- C:\laragon\www\contracts\resources\views\contracts\pagina2.blade.php --}}

<!-- ====== PÁGINA 2 INTEGRADA ====== -->
<div class="page">

@include('contracts.styles')
<x-watermark />
    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 2 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        
       <div class="subtitulo" style="margin: 18px 0 15px 0;">Payment Terms, Bill Rates, and Fees</div>
        
        {{-- Seccion 2 --}}
        <div class="texto-normal" style="margin-bottom:15px;">2. The CLIENT shall pay PRIME for the services rendered as indicated in the Scope of Work and in Annex A, at the fixed price agreed upon by the parties and specified in Annex A. PRIME shall invoice the CLIENT on a periodic basis (weekly, monthly, or as otherwise agreed) based on the completion of the tasks specified in the Scope of Work. Payment shall be made within thirty (30) days from the date of the invoice. The CLIENT's signature or another mutually agreed method of approval shall certify that the services have been satisfactorily delivered and shall authorize PRIME to invoice the CLIENT for the agreed fixed price. If any portion of an invoice is disputed, the CLIENT shall promptly pay the undisputed portion while the parties, in good faith, resolve the disputed amount.</div>

         <div style="margin-left: 25px; margin-bottom: 14px;">
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">Invoices shall be supported by the relevant timesheets or other mutually agreed systems documenting the time worked by Prime's Associates. The CLIENT's signature, or another mutually agreed method of approval of the time submitted by Prime's Associates, shall certify that the documented hours are correct and shall authorize PRIME to invoice the CLIENT for such hours.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">Although certain services under this Agreement are provided at a fixed price agreed upon between the CLIENT and PRIME, the CLIENT acknowledges that not all requested work is governed by a single rate. Depending on the type of work required, some services may be billed on an hourly basis at the applicable rates mutually agreed upon by the CLIENT and PRIME for each category of work. PRIME shall issue invoices accordingly, specifying whether the charge corresponds to the fixed-price Agreement or to hourly services performed.</div>
        </div>

        {{-- Seccion 3 --}}
        <div class="texto-normal" style="margin-bottom:15px;">3. The agreed fixed price covers all standard services outlined in the Scope of Work and in Annex A. Any additional services requested outside the scope of this agreement shall be quoted separately and shall require the prior written approval of both parties.</div>
        
          <div style="margin-left: 25px; margin-bottom: 14px;">
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">Prime Associates are presumed non-exempt from laws requiring premium pay for overtime, holiday, or weekend work. PRIME shall charge the CLIENT special premium time rates only when the work of a Prime Associate assigned to the CLIENT, considered individually, is legally required to receive premium pay and the CLIENT has authorized, directed, or permitted the Associate to perform such premium time work.</div>
            <div class="texto-normal" style="margin-bottom:8px; text-align: justify;">The special premium billing rate shall be calculated by applying exactly the same multiple to the regular billing rate that PRIME is legally required to apply to the Associate's standard pay rate. (For example, when federal law requires time-and-a-half pay for work exceeding 40 hours per week, the CLIENT shall be billed at time-and-a-half plus the margin of the regular billing rate).</div>
          </div>

        {{-- Seccion 4 --}}
        <div class="texto-normal" style="margin-bottom:15px;">4. The CLIENT acknowledges and agrees that Prime Facility Services Group shall charge applicable state taxes on all goods and services provided under this contract. The state tax rate and calculation method shall be in accordance with the applicable state tax laws and regulations in effect. The CLIENT shall be responsible for paying these state taxes in addition to the agreed fees for the contracted services. Prime Facility Services Group shall provide the CLIENT with proper documentation and receipts for state tax charges. Any changes in state tax rates or regulations shall apply to orders accordingly.</div>



        
    </div>
</div>
<x-footer-pages />

@include('contracts.pagina3_2')
