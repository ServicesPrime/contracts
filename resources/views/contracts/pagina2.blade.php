{{-- C:\laragon\www\contracts\resources\views\contracts\pagina2.blade.php --}}

<!-- ====== PÁGINA 2 ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 2 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2>Payment Terms, Bill Rates, and Fees</h2>
        
        <p class="numbered-item">2. Client shall pay PRIME for the services provided, as described in Exhibit A, at the rates specified therein. PRIME shall issue invoices to Client on a periodic basis (weekly, monthly, or as otherwise agreed), based on the completion of the tasks outlined in the Scope of Work.</p>
        
        <div class="sub-list">
            <p class="sub-item">Client acknowledges that PRIME will directly compensate the assigned employees in accordance with the established Pay Rates, and PRIME shall invoice Client for these amounts applying a thirty percent (30%) markup over the Pay Rate, which shall constitute the regular billing rate, when payment is made within fifteen (15) to thirty (30) days from the invoice date. If Client elects to make payment in fewer than fifteen (15) days, a discount of two percent (2%) shall be applied to the total invoiced amount.</p>
            <p class="sub-item">All payments must be made no later than thirty (30) days from the invoice date. Any payment made after this period shall be deemed late, and Client shall pay interest on the outstanding balance, calculated from the due date until payment is made in full, at an annual interest rate permitted by applicable law.</p>
        </div>
        
        <p class="numbered-item">3. Prime Associates are presumed to be nonexempt from laws requiring premium pay for overtime, holiday work, or weekend work. PRIME will charge CLIENT special rates for premium work time only when a Prime Associate's work on assignment to CLIENT, viewed by itself, would legally require premium pay and CLIENT has authorized, directed, or allowed the Prime Associate to work such premium work time. CLIENT's special billing rate for premium hours will be billed the exact multiple of the regular billing rate as PRIME is required to apply to the Prime Associate's standard pay rate. (For example, when federal law requires time ½ of pay for work exceeding 40 hours a week, CLIENT will be billed at time ½ plus the regular billing rate markup.)</p>
        
        <p class="numbered-item">4. In addition to the bill rates specified in Exhibit A of this agreement, CLIENT will pay PRIME the amount of all new or increased labor costs associated with CLIENT's Prime Associates that PRIME is legally required to pay—such as wages, benefits, payroll taxes, social program contributions, or charges linked to benefit levels—until the parties agree on new bill rates.</p>
        
        <p class="numbered-item">5. The Customer acknowledges and agrees that Prime Hospitality Services of Texas shall charge applicable state taxes on all goods and services provided under this contract. The rate of state taxes and the method of calculation shall be in accordance with the prevailing state tax laws and regulations. The Customer shall be responsible for paying these state taxes and the agreed-upon fees for the contracted services. Prime Hospitality Services of Texas shall provide the Customer with proper documentation and receipts for state tax charges. Any changes to state tax rates or regulations shall be applied to the orders accordingly.</p>
        
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
<!-- ====== FIN PÁGINA 2 ====== -->