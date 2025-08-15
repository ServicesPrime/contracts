{{-- C:\laragon\www\contracts\resources\views\contracts\pagina3.blade.php --}}

<!-- ====== PÁGINA 3 ====== -->
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
        
        <h2>Confidential Information</h2>
        <p>Neither party shall disclose proprietary or confidential information received from the other party, including but not limited to, methods, procedures, or any sensitive information related to the services provided. Both parties agree to hold such information in strict confidence and not to disclose such information to third parties or to use such information for any purpose whatsoever other than performing under this Agreement or as required by law. No knowledge, possession, or use of CLIENT's confidential information will be imputed to PRIME due to Prime Associates' access to such information.</p>

        <h2>Entire Agreement</h2>
        <p>This Agreement and the attached Exhibits constitute the entire agreement between the parties concerning the subject matter and supersede all previous verbal or written agreements. Any modification of this Agreement must be in writing and signed by a duly authorized party representative. There are no other understandings, obligations, representations, or warranties relating to the subject matter of this Agreement except as herein expressed. This Agreement shall supersede and shall not be modified or amended in any way by the printed terms of any invoice.</p>

        <h2>Waiver</h2>
        <p>The failure of any party to insist upon strict performance of any of the terms, conditions, and provisions of this Agreement shall not be deemed a waiver of future compliance in addition to that by the party by which the same is required to be performed hereunder. It shall in no way prejudice the remaining provisions of this Agreement. All remedies reserved to CLIENT shall be cumulative and in addition to any other or future remedies provided by law or equity.</p>

        <h2>Severability</h2>
        <p>If any provision of this Agreement or the application of any such provision to any person or in any circumstance is held invalid, the application of such provision to any other person or in any other circumstance, and the remainder of this Agreement, shall not be affected thereby and shall remain in full effect.</p>

        <h2>Cooperation</h2>
        <p>The parties agree to cooperate fully and assist the other party in investigating and resolving any complaints, scams, frauds, actions, or proceedings that may be brought by or that may involve Prime Associates.</p>
        
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
<!-- ====== FIN PÁGINA 3 ====== -->