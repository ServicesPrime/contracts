{{-- C:\laragon\www\contracts\resources\views\contracts\pagina18.blade.php --}}

<!-- ====== PÁGINA 18 - ADDITIONAL STAFF SERVICES ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 18 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">ADDITIONAL SERVICES</h2>

        <p style="margin-bottom: 30px; background-color: transparent;">
            Prime Facility Services Group offers additional specialized staff services to complement the core facility 
            management services. The following positions are available upon request with their corresponding rates.
        </p>

        <div style="margin: 30px 0;">
            <!-- Labor Rates -->
            <div style="margin-bottom: 40px;">
                <div style="background-color: #b41f24; color: white; padding: 8px 15px; font-weight: bold; font-size: 12pt; display: inline-block; margin-bottom: 0;">
                    LABOR RATES
                </div>
                <table style="width: 100%; border-collapse: collapse; background-color: transparent; margin-top: 0;">
                    <tbody>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Maintenance Helper</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent; width: 80px;">$</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Landscape</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent;">$</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Event Setup</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent;">$</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Kitchen Cleaning</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent;">$</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Day Porter</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent;">$</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Services Rates -->
            <div style="margin-bottom: 40px;">
                <div style="background-color: #b41f24; color: white; padding: 8px 15px; font-weight: bold; font-size: 12pt; display: inline-block; margin-bottom: 0;">
                    SERVICES RATES
                </div>
                <table style="width: 100%; border-collapse: collapse; background-color: transparent; margin-top: 0;">
                    <tbody>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Hood vents</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent; width: 150px;">$</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Windows cleaning</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent;">(Bid Upon Request)</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Power Washing</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent;">$</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Wood Floor Restoration</td>
                            <td style="padding: 8px 15px; text-align: left; background-color: transparent;">$</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <p style="margin-top: 25px; font-size: 10pt; color: #666; background-color: transparent;">
            <strong>Note:</strong> All rates are subject to applicable taxes and may be adjusted based on specific requirements, 
            schedule demands, or specialized skills needed. Minimum hour requirements may apply for certain positions.
        </p>
        
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
<!-- ====== FIN PÁGINA 18 ====== -->

























































{{-- C:\laragon\www\contracts\resources\views\contracts\pagina19.blade.php --}}

<!-- ====== PÁGINA 19 - ADDITIONAL STAFF SERVICES ====== -->
{{-- <div class="page">
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
    <div class="page-number">{{ $pageNumber ?? 19 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">ADDITIONAL STAFF SERVICES</h2>

        <p style="margin-bottom: 30px; background-color: transparent;">
            Prime Facility Services Group offers additional specialized staff services to complement the core facility 
            management services. The following positions are available upon request with their corresponding hourly rates.
        </p>

        <div style="margin: 30px 0;">
            <div style="margin-bottom: 40px;">
                <div style="background-color: #b41f24; color: white; padding: 8px 15px; font-weight: bold; font-size: 12pt; display: inline-block; margin-bottom: 0;">
                    HOUSEKEEPING
                </div>
                <table style="width: 100%; border-collapse: collapse; background-color: transparent; margin-top: 0;">
                    <tbody>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Housekeeping Supervisor</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent; width: 80px;">$22.40</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Project Houseman</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$17.50</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Laundry Attendant</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$17.50</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">GRA (Guest Room Attendant) Inspector</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$19.60</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Banquet Houseman</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$19.60</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Houseman</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$17.50</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Housekeeper</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$17.50</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="margin-bottom: 40px;">
                <div style="background-color: #b41f24; color: white; padding: 8px 15px; font-weight: bold; font-size: 12pt; display: inline-block; margin-bottom: 0;">
                    FOOD & BEVERAGE
                </div>
                <table style="width: 100%; border-collapse: collapse; background-color: transparent; margin-top: 0;">
                    <tbody>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Line Cook</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent; width: 80px;">$22.40</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Cook</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$21.00</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Barista</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$19.60</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Prep Cook</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$19.60</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Server</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$22.40</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Bartender</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$23.80</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Banquet Server</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$21.00</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Food Runner</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$21.00</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Busser</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$17.50</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Dishwasher</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$18.20</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Dining Room Attendant</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">$21.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <p style="margin-top: 25px; font-size: 10pt; color: #666; background-color: transparent;">
            <strong>Note:</strong> All rates are subject to applicable taxes and may be adjusted based on specific requirements, 
            schedule demands, or specialized skills needed. Minimum hour requirements may apply for certain positions.
        </p>
        
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
</div> --}}
<!-- ====== FIN PÁGINA 19 ====== -->