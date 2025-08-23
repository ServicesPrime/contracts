{{-- C:\laragon\www\contracts\resources\views\contracts\pagina11.blade.php --}}

<!-- ====== PÁGINA 11 - SERVICE AREAS ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 11 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="service-areas-title">SERVICE AREAS</h2>

        <div style="margin: 30px 0;">
            <div style="margin-bottom: 40px;">
                <div style="background-color: #b41f24; color: white; padding: 8px 15px; font-weight: bold; font-size: 12pt; display: inline-block; margin-bottom: 0;">
                    MAIN CAMPUS BUILDINGS

                </div>
                <table style="width: 100%; border-collapse: collapse; background-color: transparent; margin-top: 0;">
                    <tbody>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Levant Building</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent; width: 160px;">65,000 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Campus Center (Phase 1)</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">105,000 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Chevron Makerspace (Phase 2)</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">10,000 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Elementary School</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">105,000 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">PAAC</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">65,000 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Building A</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">25,900 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Building B</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">25,900 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Building C</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">25,900 sq ft</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="margin-bottom: 40px;">
                <div style="background-color: #b41f24; color: white; padding: 8px 15px; font-weight: bold; font-size: 12pt; display: inline-block; margin-bottom: 0;">
                    AWTY CENTER
                </div>
                <table style="width: 100%; border-collapse: collapse; background-color: transparent; margin-top: 0;">
                    <tbody>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Awty Center Pre-K</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent; width: 160px;">7,513 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Max 1</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">1,956 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Max 2</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">2,834 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Max 3</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">1,956 sq ft</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="margin-bottom: 40px;">
                <div style="background-color: #b41f24; color: white; padding: 8px 15px; font-weight: bold; font-size: 12pt; display: inline-block; margin-bottom: 0;">
                    CENTRAL STADIUM
                </div>
                <table style="width: 100%; border-collapse: collapse; background-color: transparent; margin-top: 0;">
                    <tbody>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Athletic Services</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent; width: 160px;">10,112 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Athletic Concession Stand</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">1,824 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Athletic Press Box</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">288 sq ft</td>
                        </tr>
                        <tr style="border: 1px solid #ccc;">
                            <td style="padding: 8px 15px; background-color: transparent; border-right: 1px solid #ccc;">Athletic Guard Booth</td>
                            <td style="padding: 8px 15px; text-align: right; background-color: transparent;">100 sq ft</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="text-align: right; margin-top: -10px; font-size: 14pt; font-weight: bold; color: #b41f24;">
             TOTAL: 454,283 sq ft
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
<!-- ====== FIN PÁGINA 11 ====== -->
