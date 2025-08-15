{{-- C:\laragon\www\contracts\resources\views\contracts\pagina12.blade.php --}}

<!-- ====== PÁGINA 12 - OPTIONAL PROVISIONS ====== -->
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
        
        <h2 class="optional-provisions-title">OPTIONAL PROVISIONS</h2>

        <h3>Emergency Provision</h3>
        <p>
            Prime Facility Services Group will perform the necessary services by the terms stipulated in this Agreement remotely via email and conferences.
            It is usually typical for Prime Facility Services Group to perform several site visits per week to the Client's place of business to obtain needed documents and review employee performance.
            Emergency Provisions and site visits will be limited and only necessary if required.
        </p>

        <h3>Price Increase</h3>
        <p>
            Starting from the contract inception date, an annual price increase clause of 6% shall be incorporated into this Agreement.
            Each year, on the anniversary of the contract commencement, the agreed-upon prices for the products or services provided under this Agreement will be subject to an upward adjustment following prevailing market conditions, inflation rates, and any other relevant factors.
            The price increase percentage shall be determined through a mutual agreement in good faith.
            This provision ensures that the pricing remains fair and reflects the current economic climate, enabling both parties to sustain a successful and beneficial long-term business relationship.
        </p>

        <h3>Insurance</h3>
        <p>
            During the term of this Agreement and so long after that, as Contractor may have any obligation to CLIENT under this Agreement, Contractor shall at its own cost and expense procure and maintain in full force and effect (or cause to be procured and maintained at no cost to CLIENT) insurance with sound and reputable insurance companies of the type and in such amounts as adequate for all risks by sound and prudent business practices for the type of business operation, activities, and services to be provided and performed by Contractor under this Agreement and as approved by CLIENT from time to time, including, without limitation, (i) worker's compensation and employer's liability, (ii) general liability, (iii) automobile liability and (iv) protective liability.
        </p>

        <p>
            In no event shall the insurance coverage required hereunder fall below the amounts set forth on Exhibit ___ attached hereto and incorporated herein by reference.
            Upon the execution of this Agreement, Contractor shall immediately provide to CLIENT true and accurate Certificates of Insurance (endorsed adequately by an authorized representative of the insurance company) evidencing that the insurance required hereunder is in force and effect and that such insurance will not be canceled or materially changed without giving CLIENT at least thirty (30) days prior written notice.
            Except to the extent prohibited by applicable Federal or State law, CLIENT shall be named as an additional insured and loss.
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
<!-- ====== FIN PÁGINA 12 ====== -->