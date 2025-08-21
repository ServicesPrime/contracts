{{-- C:\laragon\www\contracts\resources\views\contracts\pagina24.blade.php --}}

<!-- ====== PÁGINA 24 - COST DISTRIBUTION CHART ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 24 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">COST DISTRIBUTION ANALYSIS</h2>

        <p style="margin-bottom: 40px; background-color: transparent;">
            The following visual analysis shows the percentage distribution of all project costs, 
            providing a clear breakdown of where resources are allocated across different categories.
        </p>

        <!-- Resumen de totales -->
        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        ">
            <div style="
                background: #1e3a8a;
                color: white;
                padding: 25px;
                border-radius: 12px;
                text-align: center;
                box-shadow: 0 6px 15px rgba(30, 58, 138, 0.3);
            ">
                <h3 style="font-size: 1.1rem; margin-bottom: 10px; opacity: 0.9;">Total Project Cost</h3>
                <div style="font-size: 2.2rem; font-weight: bold;">$55,275.09</div>
            </div>
            <div style="
                background: #dc2626;
                color: white;
                padding: 25px;
                border-radius: 12px;
                text-align: center;
                box-shadow: 0 6px 15px rgba(220, 38, 38, 0.3);
            ">
                <h3 style="font-size: 1.1rem; margin-bottom: 10px; opacity: 0.9;">Total Personnel</h3>
                <div style="font-size: 2.2rem; font-weight: bold;">22 People</div>
            </div>
        </div>

        <!-- Gráfico de distribución de costos -->
        <div style="background: white; padding: 35px; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.1);">
            <h3 style="text-align: center; margin-bottom: 35px; color: #333; font-size: 1.4rem; font-weight: 600;">Percentage Breakdown by Category</h3>
            
            <div style="display: flex; flex-direction: column; gap: 20px;">
                
                <!-- Employees -->
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="min-width: 160px; font-size: 1rem; font-weight: 600; color: #333;">Employees (21)</div>
                    <div style="flex: 1; background: #e9ecef; border-radius: 10px; overflow: hidden; height: 28px; position: relative;">
                        <div style="height: 100%; background: #1e3a8a; width: 61.97%; border-radius: 10px; position: relative; transition: width 1s ease-in-out;">
                            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; font-size: 0.9rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">61.97%</span>
                        </div>
                    </div>
                    <div style="min-width: 100px; text-align: right; font-weight: bold; color: #1e3a8a; font-size: 1rem;">$34,256.25</div>
                </div>
                
                <!-- Tax & Benefits -->
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="min-width: 160px; font-size: 1rem; font-weight: 600; color: #333;">Tax & Benefits</div>
                    <div style="flex: 1; background: #e9ecef; border-radius: 10px; overflow: hidden; height: 28px; position: relative;">
                        <div style="height: 100%; background: #dc2626; width: 13.48%; border-radius: 10px; position: relative; transition: width 1s ease-in-out;">
                            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; font-size: 0.9rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">13.48%</span>
                        </div>
                    </div>
                    <div style="min-width: 100px; text-align: right; font-weight: bold; color: #dc2626; font-size: 1rem;">$7,452.60</div>
                </div>
                
                <!-- Materials -->
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="min-width: 160px; font-size: 1rem; font-weight: 600; color: #333;">Materials</div>
                    <div style="flex: 1; background: #e9ecef; border-radius: 10px; overflow: hidden; height: 28px; position: relative;">
                        <div style="height: 100%; background: #2563eb; width: 6.33%; border-radius: 10px; position: relative; transition: width 1s ease-in-out;">
                            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; font-size: 0.9rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">6.33%</span>
                        </div>
                    </div>
                    <div style="min-width: 100px; text-align: right; font-weight: bold; color: #2563eb; font-size: 1rem;">$3,500.00</div>
                </div>
                
                <!-- Operational Overhead -->
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="min-width: 160px; font-size: 1rem; font-weight: 600; color: #333;">Operational OH</div>
                    <div style="flex: 1; background: #e9ecef; border-radius: 10px; overflow: hidden; height: 28px; position: relative;">
                        <div style="height: 100%; background: #b91c1c; width: 6.32%; border-radius: 10px; position: relative; transition: width 1s ease-in-out;">
                            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; font-size: 0.9rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">6.32%</span>
                        </div>
                    </div>
                    <div style="min-width: 100px; text-align: right; font-weight: bold; color: #b91c1c; font-size: 1rem;">$3,491.35</div>
                </div>
                
                <!-- Leader -->
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="min-width: 160px; font-size: 1rem; font-weight: 600; color: #333;">Leader (1)</div>
                    <div style="flex: 1; background: #e9ecef; border-radius: 10px; overflow: hidden; height: 28px; position: relative;">
                        <div style="height: 100%; background: #1d4ed8; width: 5.67%; border-radius: 10px; position: relative; transition: width 1s ease-in-out;">
                            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; font-size: 0.9rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">5.67%</span>
                        </div>
                    </div>
                    <div style="min-width: 100px; text-align: right; font-weight: bold; color: #1d4ed8; font-size: 1rem;">$3,132.00</div>
                </div>
                
                <!-- Fixed Overhead -->
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="min-width: 160px; font-size: 1rem; font-weight: 600; color: #333;">Fixed Overhead</div>
                    <div style="flex: 1; background: #e9ecef; border-radius: 10px; overflow: hidden; height: 28px; position: relative;">
                        <div style="height: 100%; background: #991b1b; width: 4.46%; border-radius: 10px; position: relative; transition: width 1s ease-in-out;">
                            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; font-size: 0.9rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">4.46%</span>
                        </div>
                    </div>
                    <div style="min-width: 100px; text-align: right; font-weight: bold; color: #991b1b; font-size: 1rem;">$2,465.89</div>
                </div>
                
                <!-- Equipment -->
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="min-width: 160px; font-size: 1rem; font-weight: 600; color: #333;">Equipment</div>
                    <div style="flex: 1; background: #e9ecef; border-radius: 10px; overflow: hidden; height: 28px; position: relative;">
                        <div style="height: 100%; background: #1e40af; width: 1.77%; border-radius: 10px; position: relative; transition: width 1s ease-in-out;">
                            <span style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: white; font-weight: bold; font-size: 0.9rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">1.77%</span>
                        </div>
                    </div>
                    <div style="min-width: 100px; text-align: right; font-weight: bold; color: #1e40af; font-size: 1rem;">$977.00</div>
                </div>
                
            </div>
        </div>

        <!-- Nota explicativa -->
        <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-left: 4px solid #1e3a8a; border-radius: 8px;">
            <h4 style="color: #1e3a8a; margin-bottom: 10px; font-size: 1.1rem;">Analysis Summary</h4>
            <p style="color: #666; line-height: 1.5; margin: 0;">
                The largest portion of the budget (61.97%) is allocated to direct labor costs for the 21 employees. 
                Combined with leadership and benefits, personnel expenses represent approximately 81% of the total project cost, 
                reflecting the labor-intensive nature of facility management services.
            </p>
        </div>

    </div>
</div>