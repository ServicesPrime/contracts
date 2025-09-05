@include('contracts.styles')
<x-watermark />

<!-- Número de página -->
<div class="page-number">{{ $pageNumber ?? 22 }}</div>

<div class="content-padding" style="position: relative; z-index: 2;">
    
    <div class="titulo">EXHIBIT (A)</div>
    <div class="titulo">ADDITIONAL SERVICES</div>
    <br>

    <div class="texto-normal">
        Prime Facility Services Group offers additional specialized staff services to complement the core facility management services. The following positions are available upon request with their corresponding rates.
    </div>
    <br>

    <!-- Tabla LABOR RATES -->
    <div style="margin: 20px 0;">
        <div style="background-color: #c41e3a; color: white; font-weight: bold; font-size: 20px; padding: 8px 12px; display: inline-block; margin-bottom: 0;">
            LABOR RATES
        </div>
        <table class="texto-normal" style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; margin-top: 0;">
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd; width: calc(100% - 120px);">
                    Maintenance Skilled
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: right; width: 120px;">
                    $28.45
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                    Maintenance Helper
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: right;">
                    $26.10
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                    Landscape
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: right;">
                    $26.10
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                    Event Setup
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: right;">
                    $23.20
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                    Kitchen Cleaning
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: right;">
                    $24.50
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                    Day Porter
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: right;">
                    $21.00
                </td>
            </tr>
        </table>
    </div>

    <!-- Tabla SERVICE RATES -->
    <div style="margin: 20px 0;">
        <div style="background-color: #c41e3a; color: white; font-weight: bold; font-size: 20px; padding: 8px 12px; display: inline-block; margin-bottom: 0;">
            SERVICE RATES
        </div>
        <table class="texto-normal" style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; margin-top: 0;">
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd; width: calc(100% - 180px);">
                    Hood Vents
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: left; width: 180px;">
                    $650 Per Hood
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                    Windows cleaning
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: left;">
                    Bid Upon Request
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                    Power Washing
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: left;">
                    Bid Upon Request
                </td>
            </tr>
            <tr>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                    Wood Floor Restoration
                </td>
                <td style="padding: 8px 12px; border-bottom: 1px solid #ddd; text-align: left;">
                    Bid Upon Request
                </td>
            </tr>
        </table>
    </div>
    
</div>

<x-footer-pages />