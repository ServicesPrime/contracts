{{-- C:\laragon\www\contracts\resources\views\contracts\pagina23.blade.php --}}

<!-- ====== PÁGINA 23 - DETAILED COST BREAKDOWN ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 23 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">DETAILED COST BREAKDOWN</h2>

        <p style="margin-bottom: 30px; background-color: transparent;">
            The following detailed breakdown provides a comprehensive analysis of all project costs, 
            including personnel, materials, equipment, taxes, and operational overhead expenses.
        </p>



        <!-- Tabla de desglose de costos -->
        <table style="
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: white;
            font-size: 0.9rem;
        ">
            <thead>
                <tr style="background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%); color: white;">
                    <th style="padding: 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2); font-size: 0.85rem;">Concept</th>
                    <th style="padding: 12px; text-align: right; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2); font-size: 0.85rem;">Amount (USD)</th>
                    <th style="padding: 12px; text-align: center; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2); font-size: 0.85rem;">% of Total</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; font-size: 0.85rem;">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">
                        Employees 
                        <span style="
                            background: #1e3a8a;
                            color: white;
                            padding: 2px 6px;
                            border-radius: 8px;
                            font-size: 0.7rem;
                            margin-left: 6px;
                        ">(21)</span>
                    </td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$34,256.25</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">61.97%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        Salaries for workers assigned to the project (Floor Techs, Floor Man, Cleaners, Restroom Cleaners). 
                        Includes payment for hours worked at the school.
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #eee; background: rgba(0,0,0,0.02);">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">
                        Leader 
                        <span style="
                            background: #dc2626;
                            color: white;
                            padding: 2px 6px;
                            border-radius: 8px;
                            font-size: 0.7rem;
                            margin-left: 6px;
                        ">(1)</span>
                    </td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$3,132.00</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">5.67%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        Salary of the project leader or supervisor, responsible for coordinating the team and ensuring service quality.
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">Tax, Insurance & Fringe Benefits</td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$7,452.60</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">13.48%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        Social charges and legal benefits on payroll: FICA, Medicare, federal and state unemployment, 
                        workers' compensation, general insurance, Texas Franchise Tax and administrative overhead (fixed expenses).
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #eee; background: rgba(0,0,0,0.02);">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">Materials</td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$3,500.00</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">6.33%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        Cleaning supplies: detergents, disinfectants, multi-purpose cleaners, waxes, trash bags, gloves, 
                        toilet paper, towels, liquid soap, filters, pads, brushes, masks and other chemical and consumable products.
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">Equipment</td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$977.00</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">1.77%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        Cleaning machines and equipment used in the project (scrubbers, vacuums, extractors, 
                        EDIC system, etc.) financed over 48 months.
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #eee; background: rgba(0,0,0,0.02);">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">Fixed Overhead (5%)</td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$2,465.89</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">4.46%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        General company expenses that enable continuous operation: office, basic services 
                        (electricity, water, internet), insurance, licenses, administration.
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">Operational Overhead (7.0728%)</td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$3,491.35</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">6.32%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        Specific operational expenses to execute the project: field supervision, 
                        team coordination, logistics, project presentation and contract management.
                    </td>
                </tr>
                <tr style="background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); color: white; font-weight: bold;">
                    <td style="padding: 12px; border: none;"><strong>TOTAL</strong></td>
                    <td style="padding: 12px; text-align: right; border: none; font-size: 1rem;"><strong>$55,275.09</strong></td>
                    <td style="padding: 12px; text-align: center; border: none; font-size: 1rem;"><strong>100%</strong></td>
                    <td style="padding: 12px; border: none;"><strong>Total sum of all items, representing the complete cost of the project.</strong></td>
                </tr>
            </tbody>
        </table>


    </div>
</div>