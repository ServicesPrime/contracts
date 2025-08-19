{{-- C:\laragon\www\contracts\resources\views\contracts\pagina16.blade.php --}}

<!-- ====== PÁGINA 16 - PÁGINA FINAL ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 16 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <p>
            The prevailing party will be entitled to receive reasonable attorney's fees incurred during the arbitration process,
            and any other relief granted by the arbitrator will be binding upon the parties.
            The arbitrator, however, shall not have the authority to modify any terms of this Agreement.
            It should be noted that any award rendered by the arbitrator can be entered in any court of competent jurisdiction — contract interpretation.
        </p>

        <h3>Choice of Law</h3>
        <p>
            This agreement will be governed by and construed by the laws of Texas without reference to any conflicts of law principles thereof.
        </p>

        <h3>Assignment of Agreement</h3>
        <p>
            CLIENT shall not transfer or assign this Agreement without the written consent of PRIME,
            and any attempted assignment without such consent shall immediately terminate this Agreement.
        </p>

        <h3>Entire Agreement</h3>
        <p>
            This Agreement constitutes the entire agreement between the parties and supersedes all prior negotiations, representations, or agreements relating to the subject matter herein.
            This Agreement may not be modified except by a written instrument signed by both parties.
        </p>

        <h3>Severability</h3>
        <p>
            If any provision of this Agreement is held to be invalid or unenforceable, the remainder of this Agreement shall remain in full force and effect.
            The invalid or unenforceable provision shall be replaced by a valid and enforceable provision that achieves the same economic effect.
        </p>

        <h3>Counterparts</h3>
        <p>
            This Agreement may be executed in counterparts, each of which shall be deemed an original, but all of which together shall constitute one and the same instrument.
            Electronic signatures shall be deemed valid and binding.
        </p>

        <h3>Effective Date</h3>
        <p>
            This Agreement shall become effective on the date last signed by both parties and shall remain in effect for the term specified herein, unless terminated earlier in accordance with the provisions contained herein.
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
<!-- ====== FIN PÁGINA 16 ====== -->