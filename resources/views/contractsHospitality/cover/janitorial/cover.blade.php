
@include('contracts.styles')

<div class="page cover">
    @php
    $atwySChoolPath = storage_path('app/public/awty.png');
    $atwySchool64 = file_exists($atwySChoolPath)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($atwySChoolPath))
        : '';
    @endphp

    <div class="content-padding text-center p-30">
        @if($logo64)
        <img src="{{ $logo64 }}" alt="Prime Logo" style="width:800px; height:auto;" class="mt-20">
        @endif

       <div class="titulo mt-20">
            "The Best Services In The
        </div>
        <div class="titulo mt-20">
            Industry Or Nothing At All"
        </div>
         
    </div>

    @if($bldg64)
    <img src="{{ $bldg64 }}" alt="Edificio" style="width:100%; height:500px; object-fit:cover; display:block;" class="margin-y-20">
    @endif

      <div class="titulo mt-20">
    Facility Management Services Agreement
        </div>
   

    @if($atwySchool64)
    <div class="content-padding text-center p-30 mt-150">
        <img src="{{ $atwySchool64 }}" alt="AWTY School Logo" style="width:500px; height:auto;">
    </div>
    @endif


    <x-footer-cover />
</div>