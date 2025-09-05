{{-- resources/views/contracts/portada.blade.php --}}
<!-- ====== PORTADA / PRIMERA PÁGINA ====== -->
<div class="page cover">

    @php
        // Agregar la ruta del logo ATWY SCHOOL
        $atwySChoolPath = storage_path('app/public/LOGOTIPO ATWY SCHOOL.png');
        $atwySchool64 = file_exists($atwySChoolPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($atwySChoolPath)) : '';
    @endphp

    <div class="content-padding text-center">
        <!-- Logo PRIME (primera vez - arriba) -->
        @if($logo64)
            <img src="{{ $logo64 }}" alt="Prime Logo" style="width:400px; height:auto;" class="mt-20">
        @endif
    </div>

    <x-watermark />

    <!-- Sección de Agradecimiento -->
    <div class="content-padding" style="padding-top: 30px;">
        <div class="agradecimiento-section">
            <!-- Destinatario -->
            <div class="texto-normal font-bold" style="margin-bottom:25px;">
               <div style="margin:0;">{{$contract->client->name ?? $client->name ??null}}</div>
                 <div style="margin:0;">{{$contract->client->address->name_account ?? $client->address->name_account ?? null}}</div>
               <div style="margin:0;">{{$contract->client->address->street ?? $client->address->street ?? null}}</div>
                <div style="margin:0;">{{$contract->client->address->city ?? $client->address->city ?? null}}, {{$contract->client->address->state ?? $client->address->state ?? null}} {{$contract->client->address->zip_code ?? $client->address->zip_code ?? null}}</div>
            </div>
            
            <!-- Asunto -->
            <div class="script-title" style="margin:0;">
                Subject: Thank You for the Opportunity
            </div>
            
            <!-- Saludo -->
            <div class="texto-normal font-bold" style="margin-bottom:20px;">
                Dear {{$contract->client->name ?? null}},
            </div>
            
            <!-- Cuerpo de la carta -->
            <div class="texto-normal" style="margin-bottom:18px; text-align: justify;">
                On behalf of Prime Facility Services Group, I want to express our genuine gratitude for the opportunity to present a comprehensive janitorial services proposal for {{$contract->client->address->name_account  ?? null}}.
            </div>
            
            <div class="texto-normal" style="margin-bottom:18px; text-align: justify;">
                We truly appreciate the time you and your team took to meet with us and show us your beautiful facility. It is clear that Awty is more than just a school—it is a vibrant community committed to excellence in education, safety, and student well-being. That commitment deeply aligns with our own values and approach to service.
            </div>
            
            <div class="texto-normal" style="margin-bottom:18px; text-align: justify;">
                At Prime Facility Services Group, we take great pride in delivering not just cleaning, but a consistent, dependable standard of care that supports an environment where students and staff can thrive. With our proven expertise, attention to detail, and dedication to building lasting relationships, we are confident we can be the right partner to maintain the excellence that {{$contract->client->address->name_account ?? null}} represents.
            </div>
            
            <div class="texto-normal" style="margin-bottom:25px; text-align: justify;">
                Thank you again for your trust and consideration. We look forward to working together to ensure {{$contract->client->address->name_account  ?? null}} continues to shine—inside and out.
            </div>
            
            <!-- Despedida y firma -->
            <div style="margin-top:30px;">
                <div class="texto-normal font-bold" style="margin-bottom:15px;">
                    Sincerely,
                </div>
              <div class="script-title" style="margin:0;">
                    Rafael S. Perez Jr.
                </div>
                  <div class="texto-normal font-bold text-red" style="margin:0;">
                Sr. Vice President
                </div>
            </div>
        </div>
    </div>

    {{-- COMPONENTE FOOTER COVER --}}
<x-footer-pages />
</div>
<!-- ====== FIN PORTADA ====== -->