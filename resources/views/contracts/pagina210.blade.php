{{-- C:\laragon\www\contracts\resources\views\contracts\pagina20.blade.php --}}

<!-- ====== PÁGINA 20 - COST DISTRIBUTION CHART ====== -->
<div class="page">
@php
$watermarkPath = storage_path('app/public/Prime.png');
$watermark64 = file_exists($watermarkPath)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($watermarkPath))
    : '';

$graficaPath = storage_path('app/public/grafica1.png');
$grafica64 = file_exists($graficaPath)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($graficaPath))
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

    <div class="content content-with-padding" style="position: relative; z-index: 2; padding-top: 60px;">
        
        <!-- Contenedor para la imagen de gráfica -->
        <div style="
            background: white; 
            padding: 40px; 
            border-radius: 15px; 
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            margin-bottom: 50px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        ">
            <!-- Imagen de la gráfica -->
            @if($grafica64)
            <img src="{{ $grafica64 }}" alt="Cost Distribution Chart" style="
                max-width: 100%;
                height: auto;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            ">
            @else
            <div style="color: #999; padding: 40px; font-size: 1.1rem; text-align: center;">
                📊 Imagen de gráfica no encontrada<br>
                <small>Ruta: storage/app/public/grafica.png</small>
            </div>
            @endif
        </div>

    </div>

    <!-- Footer -->
    <div class="footer">
        <div style="text-align: center; color: #666; font-size: 0.9rem;">
            <div style="margin-bottom: 5px;">
                <strong>Prime Commercial Cleaning Services</strong>
            </div>
            <div style="display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
                <span>📧 info@primecleaning.com</span>
                <span>📞 (555) 123-4567</span>
                <span>📍 Houston, Texas</span>
            </div>
        </div>
    </div>
</div>

<style>
.footer {
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
    padding: 15px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

@media print {
    * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
    }
    
    .page {
        page-break-before: always;
    }
}

@media (max-width: 768px) {
    .content-with-padding {
        padding: 20px !important;
        padding-top: 40px !important;
    }
    
    .footer div[style*="gap: 30px"] {
        flex-direction: column !important;
        gap: 10px !important;
    }
}
</style>