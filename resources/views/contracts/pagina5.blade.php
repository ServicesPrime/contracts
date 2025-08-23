{{-- C:\laragon\www\contracts\resources\views\contracts\pagina5.blade.php --}}

<!-- ====== PÁGINA 5 - NOTICES ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 5 }}</div>


    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="notices-title">NOTICES</h2>
        
        <p class="notices-intro" style="text-align: left; margin: 0 0 15px 0;">
    Mail: All notices required under this Agreement shall be in writing, and if to the 
    <strong>CLIENT</strong> shall be sufficient in all respects if delivered in person or sent by a 
    nationally recognized overnight courier service or by registered or certified 
    mail to:
</p>


        {{-- <div class="notice-section" style="margin-bottom: 25px;">--}}
          {{--   <div class="notice-label">Client:</div>--}}
          {{--   <div class="notice-content" style="margin-left: 85px;">--}}
               
           {{--      <span style="margin-left: 100px; display: inline-block;">Executive Director of Facilities and Construction<br>--}}
           {{--      Scott Benson</span><br><br>--}}
           {{--      <span style="margin-left: 100px; display: inline-block;">Awty International School<br>--}}
            {{--     7455 Awty School Ln<br>--}}
            {{--     Houston, TX, 77055</span>--}}
         {{--    </div>--}}
       {{--  </div> --}}

        {{-- <div class="notice-section" style="margin-bottom: 35px;">--}}

       {{--      <div class="notice-label">Attn:</div>--}}

          {{--   <div class="notice-content" style="margin-left: -100px;"> --}}

           {{--      (713)6864850<br>--}}

           {{--      sbenson@awty.org--}}

          {{--   </div>--}}

        {{-- </div> --}}

 <div class="notice-section" style="margin-bottom: 25px;">
    <div class="notice-label">Client:</div>
    <div class="notice-content" style="margin-left: -120px;">
        {{ $contract->client->area }}<br>
        {{ $contract->client->name }}<br><br>
        {{ $contract->client->address->name_account }}<br>
        {{ $contract->client->address->street }}<br>
        {{ $contract->client->address->city }}, {{ $contract->client->address->state }}, {{ $contract->client->address->zip_code }}
    </div>
</div>

<div class="notice-section" style="margin-bottom: 35px;">
    <div class="notice-label">Attn:</div>
    <div class="notice-content" style="margin-left: -95px;">
        {{ $contract->client->phone }}<br>
        {{ $contract->client->email }}
    </div>
</div>


        <p class="notices-intro" style="text-align: left; margin: 0 0 15px 0;">
            Moreover, if to Contractor shall be sufficient in all respects if delivered in 
            person or sent by a nationally recognized overnight courier service or by 
            registered or certified mail to:
        </p>

        <div class="notice-section" style="margin-bottom: 25px;">
            <div class="notice-label">Service Provider:</div>
            <div class="notice-content" style="margin-left: -15px;">
                Prime Facility Services Group<br>
                8303 Westglen Dr<br>
                Houston, Texas 77063
            </div>
        </div>

        <div class="notice-section">
            <div class="notice-label">Attn:</div>
            <div class="notice-content" style="margin-left: 85px;">
                Patty Perez – President<br>
                Or<br>
                Rafael S. Perez Jr. – Sr. Vice President
            </div>
        </div>
        
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
<!-- ====== FIN PÁGINA 5 ====== -->