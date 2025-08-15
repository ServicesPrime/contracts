{{-- C:\laragon\www\contracts\resources\views\contracts\pagina6.blade.php --}}

<!-- ====== PÁGINA 6 - MISCELLANEOUS ====== -->
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
        
        <h2 class="miscellaneous-title">MISCELLANEOUS</h2>
        
        <p class="numbered-item">1. Provisions of this Agreement, which by their terms extend beyond the termination or nonrenewal of this Agreement, will remain effective after termination or nonrenewal.</p>
        
        <p class="numbered-item">2. No provision of this Agreement may be amended or waived unless agreed to in writing signed by both parties.</p>
        
        <p class="numbered-item">3. Each provision of this Agreement will be considered severable. If any provision or clause conflicts with existing or future applicable law or may not be given full effect because of such law, no other provision that can operate without the conflicting provision or clause will be affected.</p>
        
        <p class="numbered-item">4. This Agreement and the exhibits attached to it contain the entire understanding between the parties and supersede all prior agreements and understanding relating to the subject matter of the Agreement.</p>
        
        <p class="numbered-item">5. The provisions of this Agreement will inure to the benefit of and be binding on the parties and their respective representatives, successors, and assigns.</p>
        
        <p class="numbered-item">6. The failure of a party to enforce the provisions of this Agreement will not be a waiver of any provisions or the right of such party after that to enforce each provision of this Agreement.</p>
        
        <p class="numbered-item">7. CLIENT will not transfer or assign this Agreement without PRIME's written consent.</p>
        
        <p class="numbered-item">8. Any notice or other communication will be deemed adequately given only when sent via the United States Postal Service or a nationally recognized courier, addressed as shown on the first page of this Agreement.</p>
        
        <p class="numbered-item">9. Neither party will be responsible for failure or delay in the performance of this Agreement if the failure or delay is due to labor disputes, strikes, fire, riot, war, terrorism, acts of God, or any other causes beyond the control of the nonperforming party.</p>
        
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
<!-- ====== FIN PÁGINA 6 ====== -->