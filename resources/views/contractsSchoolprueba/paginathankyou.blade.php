{{-- C:\laragon\www\contracts\resources\views\contracts\portada.blade.php --}}
<!-- ====== PORTADA / PRIMERA PÁGINA ====== -->
<div class="page cover" style="position:relative; min-height:100vh;">


    @php
        // Agregar la ruta del logo ATWY SCHOOL
        $atwySChoolPath = storage_path('app/public/LOGOTIPO ATWY SCHOOL.png');
        $atwySchool64 = file_exists($atwySChoolPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($atwySChoolPath)) : '';
        $watermarkPath = storage_path('app/public/Prime.png');
        $watermark64 = file_exists($watermarkPath)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($watermarkPath))
            : '';
    
    @endphp

    <div class="content content-with-padding" style="text-align:center; padding:0 30px;">
        <!-- Logo PRIME (primera vez - arriba) -->
        @if($logo64)
            <img src="{{ $logo64 }}" alt="Prime Logo" style="width:400px; height:auto; margin-top:20px;">
        @endif
    </div>

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
   

    <!-- Sección de Agradecimiento -->
    <div class="agradecimiento-section" style="
        text-align:left; 
        padding:30px 50px; 
        margin:40px 0 60px; 
        color:#333333; 
        font-size:18px; 
        line-height:1.5;
        max-width:1000px;
        margin-left:auto;
        margin-right:auto;
    ">
        <!-- Destinatario -->
        <div style="margin-bottom:25px; font-weight:bold; color:#333;">
            <p style="margin:0;">Mr. Scott Benson</p>
            <p style="margin:0;">Awty International School</p>
            <p style="margin:0;">7455 Awty School Ln</p>
            <p style="margin:0;">Houston, TX 77055</p>
        </div>
        
        <!-- Asunto -->
        <p style="margin-bottom:20px; font-weight:bold; color:#b41f24; font-size:20px;">
            Subject: Thank You for the Opportunity
        </p>
        
        <!-- Saludo -->
        <p style="margin-bottom:20px; font-weight:bold;">
            Dear Mr. Benson,
        </p>
        
        <!-- Cuerpo de la carta -->
        <p style="margin-bottom:18px;">
            On behalf of Prime Facility Services Group, I want to express our genuine gratitude for the opportunity to present a comprehensive janitorial services proposal for Awty International School.
        </p>
        
        <p style="margin-bottom:18px;">
            We truly appreciate the time you and your team took to meet with us and show us your beautiful facility. It is clear that Awty is more than just a school—it is a vibrant community committed to excellence in education, safety, and student well-being. That commitment deeply aligns with our own values and approach to service.
        </p>
        
        <p style="margin-bottom:18px;">
            At Prime Facility Services Group, we take great pride in delivering not just cleaning, but a consistent, dependable standard of care that supports an environment where students and staff can thrive. With our proven expertise, attention to detail, and dedication to building lasting relationships, we are confident we can be the right partner to maintain the excellence that Awty represents.
        </p>
        
        <p style="margin-bottom:25px;">
            Thank you again for your trust and consideration. We look forward to working together to ensure Awty International School continues to shine—inside and out.
        </p>
        
        <!-- Despedida y firma -->
        <div style="margin-top:30px;">
            <p style="margin-bottom:15px; font-weight:bold;">
                Sincerely,
            </p>
            <p style="margin:0; font-weight:bold; color:#b41f24;">
                Rafael S. Perez Jr.
            </p>
            <p style="margin:0; font-weight:bold; color:#b41f24;">
                Sr. Vice President
            </p>
        </div>
    </div>

    <!-- Footer especial solo para la portada -->
    <div class="footer-cover" style="
        position:absolute; 
        left:0; 
        right:0; 
        bottom:20px; 
        text-align:center; 
        color:#b41f24; 
        font-weight:bold; 
        font-size:24px; 
        line-height:1.5;
    ">
        <div>8303 Westglen Dr - Houston, TX 77063 ~ Phone 713-338-2553 ~ Fax 713-574-3065</div>
        <div>www.primefacilityservicesgroup.com</div>
    </div>
</div>
<!-- ====== FIN PORTADA ====== -->