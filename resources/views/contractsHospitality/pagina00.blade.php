{{-- C:\laragon\www\contracts\resources\views\contracts\portada.blade.php --}}

<!-- ====== PORTADA / PRIMERA PÁGINA ====== -->

<div class="page cover" style="position:relative; min-height:100vh;">
 @php
// Agregar la ruta del logo ATWY SCHOOL
$hospitalityPatch = storage_path('app/public/primeh.png');
$atwySchool64 = file_exists($hospitalityPatch)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($hospitalityPatch))
    : '';
@endphp



    <div class="content content-with-padding" style="text-align:center; padding:0 30px;">
        <!-- Logo PRIME (primera vez - arriba) -->
        @if($logo64)
        <img src="{{ $logo64 }}" alt="Prime Logo" style="width:800px; height:auto; margin-top:20px;">
        @endif

        <p style="color:#b41f24; font-size:60px; text-align:center; margin:10px 0 30px; font-weight:bold;">
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

    <!-- Logo AWTY SCHOOL (reemplazando el segundo logo de PRIME) -->
    @if($atwySchool64)
    <div class="content-with-padding" style="text-align:center; margin-top:150px; padding:0 30px;">
        <img src="{{ $atwySchool64 }}" alt="AWTY School Logo" style="width:500px; height:auto;">
    </div>
    @endif 

<x-footer-pages-hospitality />
</div>

