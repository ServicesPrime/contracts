{{-- C:\laragon\www\contracts\resources\views\contracts\pagina4.blade.php --}}

<!-- ====== PÁGINA 4 ====== -->
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
<div class="page-number">{{ $pageNumber ?? 4 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2>Indemnification and Limitation of Liability</h2>
        
        <p class="numbered-item">1. To the extent permitted by law, PRIME will defend, indemnify, and hold CLIENT harmless from all claims, losses, and liabilities arising directly from PRIME's execution of the services described in this Agreement, including any damages caused by negligence or failure to meet agreed-upon standards.</p>
        
        <p class="numbered-item">2. To the extent permitted by the law, CLIENT will defend, indemnify, and hold PRIME and its parent, subsidiaries, directors, officers, agents, representatives, and employees harmless from all claims, losses, and liabilities (including reasonable attorneys' fees) to the extent caused by CLIENT's breach of this agreement; its failure to discharge its duties and responsibilities outlined in paragraph 2; or the negligence, gross negligence, or willful misconduct of CLIENT or CLIENT's officers, employees, or authorized agents in the discharge of those duties and responsibilities.</p>
        
        <p class="numbered-item">3. Neither party shall be liable for or be required to indemnify the other party for any incidental, consequential, exemplary, special, punitive, or lost profit damages that arise in connection with this Agreement, regardless of the form of action (whether in contract, tort, negligence, strict liability, or otherwise) and regardless of how characterized, even if such a party has been advised of the possibility of such damages.</p>
        
        <p class="numbered-item">4. As a condition precedent to indemnification, the party seeking indemnification will perform the other party within (2) business days after it received notice of any claim, liability, or demand for which it seeks indemnification from the other party, and the party seeking indemnification will cooperate in the investigation and defense of any such matter.</p>
        
        <p class="numbered-item">5. The provisions of this agreement constitute the complete agreement between the parties concerning indemnification, and each party waives the right to assert any common-law indemnification or contribution claim against the other party.</p>
        
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
<!-- ====== FIN PÁGINA 4 ====== -->