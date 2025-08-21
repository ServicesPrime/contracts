{{-- C:\laragon\www\contracts\resources\views\contracts\pagina22.blade.php --}}

<!-- ====== PÁGINA 22 - BUDGET BREAKDOWN ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 22 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">BUDGET BREAKDOWN</h2>

        <p style="margin-bottom: 30px; background-color: transparent;">
            The following breakdown details all costs associated with the facility management services 
            outlined in this agreement, including labor, materials, equipment, and applicable taxes.
        </p>

        <div style="margin: 50px auto; max-width: 600px;">
            <table style="width: 100%; border-collapse: collapse; background-color: transparent; border: 2px solid #b41f24;">
                <tbody>
                    <tr style="border-bottom: 1px solid #ccc;">
                        <td style="padding: 15px 20px; background-color: transparent; border-right: 1px solid #ccc; font-weight: normal;">21 Employees</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: transparent; font-weight: normal;">$34,256.25</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ccc;">
                        <td style="padding: 15px 20px; background-color: transparent; border-right: 1px solid #ccc; font-weight: normal;">1 Leader</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: transparent; font-weight: normal;">$3,132.00</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ccc;">
                        <td style="padding: 15px 20px; background-color: transparent; border-right: 1px solid #ccc; font-weight: normal;">Tax, Insurance and Fringe Benefits</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: transparent; font-weight: normal;">$7,452.60</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ccc;">
                        <td style="padding: 15px 20px; background-color: transparent; border-right: 1px solid #ccc; font-weight: normal;">Materials</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: transparent; font-weight: normal;">$3,500.00</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ccc;">
                        <td style="padding: 15px 20px; background-color: transparent; border-right: 1px solid #ccc; font-weight: normal;">Equipment</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: transparent; font-weight: normal;">$977.00</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ccc;">
                        <td style="padding: 15px 20px; background-color: transparent; border-right: 1px solid #ccc; font-weight: normal;">Overhead</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: transparent; font-weight: normal;">$2,465.89</td>
                    </tr>
                    <tr style="border-bottom: 2px solid #b41f24;">
                        <td style="padding: 15px 20px; background-color: transparent; border-right: 1px solid #ccc; font-weight: normal;">Profit</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: transparent; font-weight: normal;">$3,491.35</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #ccc; background-color: rgba(180, 31, 36, 0.1);">
                        <td style="padding: 15px 20px; background-color: rgba(180, 31, 36, 0.1); border-right: 1px solid #ccc; font-weight: bold; color: #b41f24;">Subtotal</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: rgba(180, 31, 36, 0.1); font-weight: bold; color: #b41f24;">$55,275.09</td>
                    </tr>
                    <tr style="border-bottom: 2px solid #b41f24;">
                        <td style="padding: 15px 20px; background-color: transparent; border-right: 1px solid #ccc; font-weight: normal;">State Taxes</td>
                        <td style="padding: 15px 20px; text-align: right; background-color: transparent; font-weight: normal;">$4,560.19</td>
                    </tr>
                    <tr style="background-color: rgba(180, 31, 36, 0.2);">
                        <td style="padding: 20px; background-color: rgba(180, 31, 36, 0.2); border-right: 1px solid #b41f24; font-weight: bold; color: #b41f24; font-size: 14pt;">TOTAL</td>
                        <td style="padding: 20px; text-align: right; background-color: rgba(180, 31, 36, 0.2); font-weight: bold; color: #b41f24; font-size: 14pt;">$59,835.28</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style="margin-top: 40px; font-size: 10pt; color: #666; background-color: transparent; text-align: center;">
            <strong>Note:</strong> All amounts are in USD and subject to the terms and conditions outlined in this service agreement. 
            State taxes are calculated based on current applicable rates and may be subject to change.
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
<!-- ====== FIN PÁGINA 22 ====== -->