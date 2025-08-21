{{-- C:\laragon\www\contracts\resources\views\contracts\pagina20.blade.php --}}

<!-- ====== PÁGINA 20 - DETAILED COST BREAKDOWN ====== -->
<div class="page">
@php
$watermarkPath = storage_path('app/public/Prime.png');
$watermark64 = file_exists($watermarkPath)
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($watermarkPath))
    : '';

// Cálculos para impuestos
$subtotal = 55275.09;
$taxRate = 0.0825; // 8.25%
$taxAmount = $subtotal * $taxRate;
$finalTotal = $subtotal + $taxAmount;
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
            background-color: transparent;
            font-size: 0.9rem;
        ">
            <thead>
                <tr style="
                    background: #162469ff !important;
                    background-color: #162469ff !important;
                    color: white !important;
                ">
                    <th style="
                        padding: 12px; 
                        text-align: left; 
                        font-weight: 600; 
                        border-right: 1px solid rgba(255,255,255,0.3); 
                        font-size: 0.85rem;
                        background-color: inherit;
                        color: inherit;
                    ">Concept</th>
                    <th style="
                        padding: 12px; 
                        text-align: right; 
                        font-weight: 600; 
                        border-right: 1px solid rgba(255,255,255,0.3); 
                        font-size: 0.85rem;
                        background-color: inherit;
                        color: inherit;
                    ">Amount (USD)</th>
                    <th style="
                        padding: 12px; 
                        text-align: center; 
                        font-weight: 600; 
                        border-right: 1px solid rgba(255,255,255,0.3); 
                        font-size: 0.85rem;
                        background-color: inherit;
                        color: inherit;
                    ">% of Total</th>
                    <th style="
                        padding: 12px; 
                        text-align: left; 
                        font-weight: 600; 
                        font-size: 0.85rem;
                        background-color: inherit;
                        color: inherit;
                    ">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">
                        Employees
                    </td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$34,256.25</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">61.97%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        Salaries for workers assigned to the project (Floor Techs, Floor Man, Cleaners, Restroom Cleaners). 
                        Includes payment for hours worked at the school.
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #eee; background-color: rgba(0,0,0,0.02);">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">
                        Leader
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
                <tr style="border-bottom: 1px solid #eee; background-color: rgba(0,0,0,0.02);">
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
                <tr style="border-bottom: 1px solid #eee; background-color: rgba(0,0,0,0.02);">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">Fixed Overhead</td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$2,465.89</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">4.46%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        General company expenses that enable continuous operation: office, basic services 
                        (electricity, water, internet), insurance, licenses, administration.
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 12px; font-weight: 600; color: #333;">Operational Overhead</td>
                    <td style="padding: 10px 12px; text-align: right; font-weight: bold; color: #dc2626;">$3,491.35</td>
                    <td style="padding: 10px 12px; text-align: center; font-weight: 600; color: #dc2626;">6.32%</td>
                    <td style="padding: 10px 12px; color: #666; font-size: 0.85rem; line-height: 1.3;">
                        Specific operational expenses to execute the project: field supervision, 
                        team coordination, logistics, project presentation and contract management.
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <!-- SUBTOTAL -->
                <tr style="
                    background-color: #f8f9fa !important;
                    color: #333 !important;
                    font-weight: bold;
                    border-top: 2px solid #ddd;
                ">
                    <td style="
                        padding: 12px; 
                        border: none; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>SUBTOTAL</strong></td>
                    <td style="
                        padding: 12px; 
                        text-align: right; 
                        border: none; 
                        font-size: 1rem; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>${{ number_format($subtotal, 2) }}</strong></td>
                    <td style="
                        padding: 12px; 
                        text-align: center; 
                        border: none; 
                        font-size: 1rem; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>100%</strong></td>
                    <td style="
                        padding: 12px; 
                        border: none; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>Subtotal before state taxes.</strong></td>
                </tr>
                
                <!-- TAXES ESTATE -->
                <tr style="
                    background-color: #fff3cd !important;
                    color: #856404 !important;
                    font-weight: bold;
                ">
                    <td style="
                        padding: 12px; 
                        border: none; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>Taxes Estate (8.25%)</strong></td>
                    <td style="
                        padding: 12px; 
                        text-align: right; 
                        border: none; 
                        font-size: 1rem; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>${{ number_format($taxAmount, 2) }}</strong></td>
                    <td style="
                        padding: 12px; 
                        text-align: center; 
                        border: none; 
                        font-size: 1rem; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>{{ number_format(($taxAmount / $finalTotal) * 100, 2) }}%</strong></td>
                    <td style="
                        padding: 12px; 
                        border: none; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>State taxes applied at 8.25% rate.</strong></td>
                </tr>

                <!-- TOTAL FINAL -->
                <tr style="
                    background-color: #162469ff !important;
                    color: white !important;
                    font-weight: bold;
                    border-top: 2px solid #162469ff;
                ">
                    <td style="
                        padding: 12px; 
                        border: none; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                        font-size: 1.1rem;
                    "><strong>TOTAL</strong></td>
                    <td style="
                        padding: 12px; 
                        text-align: right; 
                        border: none; 
                        font-size: 1.1rem; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>${{ number_format($finalTotal, 2) }}</strong></td>
                    <td style="
                        padding: 12px; 
                        text-align: center; 
                        border: none; 
                        font-size: 1rem; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>-</strong></td>
                    <td style="
                        padding: 12px; 
                        border: none; 
                        font-weight: bold;
                        background-color: inherit;
                        color: inherit;
                    "><strong>Final total including all costs and state taxes.</strong></td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>