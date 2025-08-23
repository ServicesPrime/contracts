{{-- C:\laragon\www\contracts\resources\views\contracts\pagina9.blade.php --}}

<!-- ====== PÁGINA 9 - CONTINUACIÓN ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 9 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <p>
            Payee on all such insurance policies. The Contractor's requirement to procure and maintain such insurance coverage shall not negate or reduce Contractor's obligations.
            CLIENT shall have the right to require Contractor to increase the amounts and otherwise upgrade the insurance provided by Contractor hereunder as CLIENT deems appropriate in its reasonable discretion.
            This section 9 shall survive the expiration or termination of this Agreement.
        </p>

        <p>
            As necessary, per negotiation On CLIENT's request, PRIME will give CLIENT certificates of this insurance coverage or, with the insurer's concurrence, make CLIENT an additional insured for PRIME's services.
        </p>

        <h3>Late Payment Penalty</h3>
        <p>
            CLIENT agrees to pay within 30 days from the date of the invoice. Any unpaid balances after the 
agreed payment term shall accrue interest at the applicable legal rate in effect, calculated from the end 
of the payment term until full payment is received.
        </p>

        <h3>No Staff Hire - Always; Fee</h3>
        <p>
            CLIENT and PRIME agree that, during the term of this Agreement and for a period of two (2) years 
thereafter, neither party shall directly or indirectly hire, solicit, or otherwise engage the services of any 
personnel directly involved in the execution of this Agreement, without the prior written consent of the 
other party. In the event of a breach, the violating party shall pay the other party a placement and 
training fee equal to thirty percent (30%) of the employee’s annualized compensation with the new 
employer.
        </p>

        <h3>Nature of Relationship</h3>
        <p>
            The services that PRIME will render to CLIENT under this agreement will be as an independent contractor.
            Nothing contained in this Agreement will be construed to create the relationship of principal and agent, or employer and employee, between PRIME and CLIENT.
        </p>

        <h3>Headings</h3>
        <p>
            The headings of the paragraphs of this Agreement are inserted for the convenience of reference.
            They will in no way define, limit, extend, or aid in the construction of the scope, extent, or intent of this Agreement.
        </p>

        <h3>Arbitration</h3>
        <p>
            In the event of any controversy or dispute arising from this Agreement, the party at fault will be responsible for covering all expenses related to arbitration, as per the Federal Arbitration Act and before the American Arbitration Association (AAA) at the AAA location in Texas closest to PRIME's office.
        </p>
        
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
<!-- ====== FIN PÁGINA 9 ====== -->