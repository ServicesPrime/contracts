{{-- C:\laragon\www\contracts\resources\views\contracts\portada.blade.php --}}

<!-- ====== PORTADA / PRIMERA PÁGINA ====== -->
<div class="page cover" style="position:relative; min-height:100vh;">
    <div class="content content-with-padding" style="text-align:center; padding:0 30px;">
        <!-- Logo PRIME (primera vez - arriba) -->
        @if($logo64)
        <img src="{{ $logo64 }}" alt="Prime Logo" style="width:800px; height:auto; margin-top:20px;">
        @endif

        <p style="color:#b41f24; font-size:38px; text-align:center; margin:10px 0 30px;">
            "The Best Services In The<br>
            Industry Or Nothing At All"
        </p>
    </div>

    <!-- Imagen Edificio (de lado a lado completo - SIN padding) -->
    @if($bldg64)
    <img src="{{ $bldg64 }}" alt="Edificio" style="width:100%; height:500px; object-fit:cover; display:block; margin:20px 0;">
    @endif

    <!-- Texto Facility Management Services Agreement -->
    <div class="content-with-padding" style="text-align:center; font-size:40px; color:#b41f24; font-weight:bold; margin-top:20px; padding:0 30px;">
        Facility Management Services Agreement
    </div>

    <!-- Logo PRIME (segunda vez - MOVIDO MUCHO MÁS ABAJO) -->
    @if($logo64)
    <div class="content-with-padding" style="text-align:center; margin-top:150px; padding:0 30px;">
        <img src="{{ $logo64 }}" alt="Prime Logo" style="width:400px; height:auto;">
    </div>
    @endif

    <!-- Footer especial solo para la portada -->
    <div class="footer-cover" style="
        position:absolute; left:0; right:0; bottom:20px;
        text-align:center; color:#b41f24; font-weight:bold;
        font-size:24px; line-height:1.5;">
        <div>8303 Westglen Dr - Houston, TX 77063 ~ Phone 713-338-2553 ~ Fax 713-574-3065</div>
        <div>www.primefacilityservicesgroup.com</div>
    </div>
</div>
<!-- ====== FIN PORTADA ====== -->