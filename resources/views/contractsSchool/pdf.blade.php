<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Order - {{ $contract->contract_number }}</title>

    <!-- Inter - La alternativa MÁS parecida a Gotham -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        @page {
            margin: 40px 40px;
            size: A4;
        }

        * {
            font-family: "Inter", sans-serif !important;
        }

        body {
            font-family: "Inter", sans-serif;
            font-size: 20px;
            color: #1c2969;
            margin: 0;
            padding: 0;
            line-height: 1.3;
            padding-bottom: 80px;
        }

        .header {
            margin-bottom: 15px;
            position: relative;
            width: 100%;
            min-height: 120px;
        }

        .header-logo {
            width: 50%;
            max-width: 300px;
            height: auto;
            display: block;
        }

        .header-text {
            position: absolute;
            top: -10px;
            right: 0;
            width: 60%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .header-text h1 {
            font-family: "Gotham";
            font-size: 50px;
            color: #b91f32;
            margin: 0;
            font-weight: bold;
            line-height: 1;
        }

        .header-text p {
            font-family: "Gotham";
            font-size: 26px;
            color: #1c2969;
            margin: 5px 0 0 0;
            font-style: italic;
            line-height: 1;
        }

        .content-container {
            width: 95%;
            margin: 0 auto;
            font-size: 21px;
        }

        .content-container * {
            font-size: inherit !important;
            font-family: "Inter", sans-serif !important;
        }

        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .info-left,
        .info-center,
        .info-right {
            display: table-cell;
            vertical-align: top;
            padding-right: 15px;
        }

        .info-left {
            width: 30%;
        }

        .info-center {
            width: 35%;
        }

        .info-right {
            width: 35%;
            padding-right: 0;
        }

        .label {
            color: #b91f32;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 3px;
            display: block;
            font-family: "Gotham";
        }

        .value {
            color: #1c2969;
            font-size: 20px;
            line-height: 1.3;
            margin-bottom: 8px;
            font-family: "Gotham";
        }

        .work-order-number {
            color: #b91f32;
            font-weight: bold;
            font-size: 20px;
            font-family: "Gotham";
        }

        .details-section {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .detail-item {
            display: table-cell;
            width: 20%;
            vertical-align: top;
            padding-right: 10px;
        }

        .detail-item:last-child {
            padding-right: 0;
        }

        .contract-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            margin-bottom: 20px;
            font-size: 20px;
            font-family: "Gotham";
        }

        .contract-table th {
            background-color: #b91f32;
            color: white;
            padding: 6px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border: 1px solid #b91f32;
            font-family: "Gotham";
        }

        .contract-table td {
            border: 1px solid #b91f32;
            padding: 6px;
            text-align: center;
            background-color: white;
            font-size: 20px;
            font-family: "Gotham";
        }

        .specifications-section {
            margin-bottom: 15px;
        }

        .section-title {
            color: #b91f32;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            font-family: "Gotham";
        }

        .spec-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .spec-item {
            color: #1c2969;
            font-size: 10px;
            margin-bottom: 3px;
            padding-left: 12px;
            position: relative;
            font-family: "Gotham";
        }

        .spec-item:before {
            content: "•";
            color: #b91f32;
            font-weight: bold;
            position: absolute;
            left: 0;
            font-family: "Gotham";
        }

        .terms-section {
            margin-top: 15px;
        }

        .terms-subsection {
            margin-bottom: 12px;
        }

        .terms-subtitle {
            color: #1c2969;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
            font-family: "Gotham";
        }

        .terms-item {
            color: #1c2969;
            font-size: 20px;
            margin-bottom: 2px;
            padding-left: 12px;
            position: relative;
            font-family: "Gotham";
        }

        .terms-item:before {
            content: "•";
            color: #1c2969;
            position: absolute;
            left: 0;
            font-family: "Gotham";
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .footer-logo {
            width: 100%;
            height: auto;
            display: block;
        }

        .page-footer {
            position: absolute;
            bottom: 80px;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
        }

        .page-footer-logo {
            width: 100%;
            height: auto;
            display: block;
        }

        .page-container {
            position: relative;
            min-height: 100vh;
            padding-bottom: 120px;
        }

        .three-columns {
            width: 100%;
            display: table;
            table-layout: fixed;
            margin-bottom: 20px;
        }


        .column {
            display: table-cell;
            vertical-align: top;
            padding-right: 20px;
        }

        /* Primera columna (WORK SITE) - un poco más estrecha */
        .column:nth-child(1) {
            width: 28%;
        }

        /* Segunda columna (BILL TO) - más ancha para el email */
        .column:nth-child(2) {
            width: 40%;
        }

        /* Tercera columna (WORK ORDER) - un poco más estrecha */
        .column:nth-child(3) {
            width: 32%;
            padding-right: 0;
        }

        .column:last-child {
            padding-right: 0;
        }

        .work-order-text {
            font-size: 20px;
            color: #1c2969;
            margin-bottom: 5px;
            line-height: 1.3;
            font-family: "Gotham";
        }

        .work-order-label {
            color: #b91f32;
            font-weight: bold;
            font-size: 20px;
            display: block;
            margin-bottom: 5px;
            font-family: "Gotham";
        }

        .work-order-value {
            color: #b91f32;
            font-weight: bold;
            font-size: 20px;
            display: block;
            font-family: "Gotham";
        }

        .details-grid {
            width: 100%;
            margin-top: 20px;
        }

        .details-row {
            width: 100%;
            display: table;
            table-layout: fixed;
            margin-bottom: 15px;
        }

        .detail-cell {
            display: table-cell;
            width: 33.33%;
            vertical-align: top;
            padding-right: 20px;
        }

        .detail-cell:last-child {
            padding-right: 0;
        }

        .detail-label {
            color: #b91f32;
            font-size: 10px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            font-family: "Gotham";
        }

        .detail-value {
            color: #1c2969;
            font-size: 10px;
            display: block;
            font-family: "Gotham";
        }

        .bottom-row {
            width: 100%;
            display: table;
            table-layout: fixed;
            margin-top: 10px;
        }

        .bottom-cell {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }

        .bottom-cell:last-child {
            padding-right: 0;
        }

        .bottom-label {
            color: #b91f32;
            font-size: 10px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            font-family: "Gotham";
        }

        .bottom-value {
            color: #1c2969;
            font-size: 10px;
            display: block;
            font-family: "Gotham";
        }

        .specifications-title {
            color: #b91f32;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #b91f32;
            padding-bottom: 5px;
            font-family: "Gotham";
        }

        .specification-item {
            color: #1c2969;
            font-size: 10px;
            margin-bottom: 5px;
            padding-left: 15px;
            position: relative;
            font-family: "Gotham";
        }

        .specification-item:before {
            content: "•";
            color: #b91f32;
            font-weight: bold;
            position: absolute;
            left: 0;
            font-family: "Gotham";
        }

        .terms-service {
            margin-bottom: 15px;
        }

        .terms-service-title {
            color: #1c2969;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
            font-family: "Gotham";
        }

        .single-details-row {
            width: 100%;
            display: table;
            table-layout: fixed;
            margin-bottom: 15px;
        }

        .single-detail-cell {
            display: table-cell;
            width: 20%;
            /* 5 columnas = 20% cada una */
            vertical-align: top;
            padding-right: 15px;
        }

        .single-detail-cell:last-child {
            padding-right: 0;
        }

        /* PAGE BREAK STYLES */
        .page-break {
            page-break-before: always;
            break-before: page;
        }

        /* SEGUNDA PÁGINA STYLES */
        .second-page {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding-top: 100px;
            padding-bottom: 120px;
        }

        .bottom-section {
            margin-top: auto;
            padding: 40px 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 60px;
        }

        .instructions-container {
            flex: 1;
            max-width: 50%;
        }

        .signature-section-horizontal {
            flex: 0 0 45%;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 25px;
            margin-top: 20px;
        }

        .signature-row {
            display: block;
            width: 100%;
        }

        .signature-cell {
            display: block;
            width: 300px;
            text-align: right;
            margin-bottom: 25px;
        }

        .signature-cell:last-child {
            margin-bottom: 0;
        }

        .signature-label-top {
            color: #1c2969;
            font-size: 18px;
            font-weight: bold;
            font-family: "Inter", sans-serif;
            margin-bottom: 12px;
            text-align: right;
        }

        .signature-line-horizontal {
            border-bottom: 2px solid #b91f32;
            height: 50px;
            width: 100%;
        }

        .instruction-text {
            color: #b91f32;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
            font-family: "Inter", sans-serif;
        }

        .instruction-detail {
            color: #1c2969;
            font-size: 18px;
            margin-bottom: 20px;
            font-family: "Inter", sans-serif;
            line-height: 1.4;
        }

        .send-to-text {
            color: #b91f32;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            font-family: "Inter", sans-serif;
        }

        .company-info {
            color: #1c2969;
            font-size: 18px;
            font-family: "Inter", sans-serif;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            gap: 40px;
        }

        .signature-box {
            flex: 1;
            text-align: center;
        }

        .signature-line {
            border-bottom: 2px solid #1c2969;
            margin-bottom: 10px;
            height: 60px;
            display: flex;
            align-items: flex-end;
        }

        .signature-label {
            color: #1c2969;
            font-size: 18px;
            font-weight: bold;
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body>
    <!-- PRIMERA PÁGINA -->
    <div class="page-container">
        <!-- Header -->
        <div class="header">
        @php
        $imagePath = storage_path('app/public/imagenes/prime7.png');
        $imageData = '';
        if (file_exists($imagePath)) {
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageMimeType = mime_content_type($imagePath);
        $imageDataUri = 'data:' . $imageMimeType . ';base64,' . $imageData;
        }
        @endphp

        @if(!empty($imageData))
        <img src="{{ $imageDataUri }}" alt="Prime Logo" class="header-logo">
        @endif

        <div class="header-text">
            <h1>JOB WORK ORDER</h1>
            <p>"The Best Services in the Industry or Nothing at All"</p>
        </div>

        <!-- Footer Página 1 -->
        <div class="page-footer">
            @php
            $footerImagePath = storage_path('app/public/imagenes/prime8.png');
            $footerImageData = '';
            if (file_exists($footerImagePath)) {
            $footerImageData = base64_encode(file_get_contents($footerImagePath));
            $footerImageMimeType = mime_content_type($footerImagePath);
            $footerImageDataUri = 'data:' . $footerImageMimeType . ';base64,' . $footerImageData;
            }
            @endphp

            @if(!empty($footerImageData))
            <img src="{{ $footerImageDataUri }}" alt="Prime Footer" class="page-footer-logo">
            @endif
        </div>
    </div>

    <!-- Content Container -->
    <div class="content-container">
        <!-- Three Columns Section -->
        <div class="three-columns">
            <div class="column">
                <span class="label">WORK SITE:</span>
                <span class="value">
                    @if($contract->client && $contract->client->address)
                    @if($contract->client->address->name_account)
                    {{ $contract->client->address->name_account }}<br>
                    @endif
                    @if($contract->client->address->street)
                    {{ $contract->client->address->street }}<br>
                    @endif
                    @if($contract->client->address->city || $contract->client->address->state || $contract->client->address->zip_code)
                    {{ collect([$contract->client->address->city, $contract->client->address->state, $contract->client->address->zip_code])->filter()->implode(', ') }}<br>
                    @endif
                    @if($contract->client->address->country)
                    {{ $contract->client->address->country }}<br>
                    @endif
                    @if($contract->client->address->full_address && !$contract->client->address->street)
                    {{ $contract->client->address->full_address }}<br>
                    @endif
                    @else
                    <em>No address available</em>
                    @endif
                </span>
            </div>

            <div class="column">
                <span class="label">BILL TO:</span>
                <span class="value">
                    @if($contract->client)
                    {{ $contract->client->name }}<br>
                    {{ $contract->client->email ?? 'N/A' }}<br>
                    {{ $contract->client->phone ?? 'N/A' }}<br>
                    @if($contract->client->area)
                    {{ $contract->client->area }}
                    @endif
                    @else
                    <em>No client information available</em>
                    @endif
                </span>
            </div>

            <div class="column">
                <div class="work-order-text">
                    The following number must appear on all related correspondence, shipping papers, and invoices:
                </div>
                <span class="work-order-label">WORK ORDER NUMBER:</span>
                <span class="work-order-value">{{ $contract->contract_number }}</span>
            </div>
        </div>

        <!-- Details Section -->
        <div class="details-grid">
            <div class="single-details-row">
                <div class="single-detail-cell">
                    <span class="detail-label">WORK DATE:</span>
                    <span class="detail-value">{{ $contract->date ? \Carbon\Carbon::parse($contract->date)->format('m/d/Y') : 'N/A' }}</span>
                </div>
                <div class="single-detail-cell">
                    <span class="detail-label">REQUESTED BY:</span>
                    <span class="detail-value">{{ $contract->client->name ?? 'N/A' }}</span>
                </div>
                <div class="single-detail-cell">
                    <span class="detail-label">DEPARTMENT:</span>
                    <span class="detail-value">{{ $contract->department ?? 'N/A' }}</span>
                </div>
                <div class="single-detail-cell">
                    <span class="detail-label">INVOICE:</span>
                    <span class="detail-value">{{ $contract->contract_number }}</span>
                </div>
                <div class="single-detail-cell">
                    <span class="detail-label">TERMS:</span>
                    <span class="detail-value">15</span>
                </div>
            </div>
        </div>

        <!-- Contract Services Table - Only show paid services -->
        @php
        $paidServices = $contract->contractServices->filter(function($cs) {
        return $cs->service && $cs->service->type === 'service' && $cs->quantity && $cs->unit_price;
        });
        $totalAmount = $paidServices->sum(function($cs) {
        return $cs->quantity * $cs->unit_price;
        });
        @endphp

        @if($paidServices->count() > 0)
        <table class="contract-table">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Type of Service</th>
                    <th>Frequency</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paidServices as $contractService)
                <tr>
                    <td>
                        @if($contract->client && $contract->client->address)
                        {{ collect([$contract->client->address->city, $contract->client->address->state])->filter()->implode(', ') }}
                        @else
                        N/A
                        @endif
                    </td>
                    <td>{{ $contractService->service->service ?? 'N/A' }}</td>
                    <td>Monthly</td>
                    <td>{{ $contractService->quantity }}</td>
                    <td>${{ number_format($contractService->unit_price, 2) }}</td>
                    <td>${{ number_format($contractService->quantity * $contractService->unit_price, 2) }}</td>
                </tr>
                @endforeach
                <!-- Total Row -->
                <tr style="background-color: #f0f0f0; font-weight: bold;">
                    <td colspan="5" style="text-align: right;">TOTAL AMOUNT:</td>
                    <td>${{ number_format($totalAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>
        @endif

        <!-- Service Specifications Section -->
        @php
        $serviceSpecifications = collect();
        foreach($contract->contractServices as $cs) {
        if($cs->service && $cs->service->type === 'service' && $cs->service->specifications) {
        foreach($cs->service->specifications as $spec) {
        $serviceSpecifications->push($spec);
        }
        }
        }
        $serviceSpecifications = $serviceSpecifications->unique('description');
        @endphp

        @if($serviceSpecifications->count() > 0)
        <div class="specifications-section">
            <div class="specifications-title">SERVICE SPECIFICATIONS:</div>
            @foreach($serviceSpecifications as $specification)
            <div class="specification-item">{{ $specification->description }}</div>
            @endforeach
        </div>
        @endif

        <!-- Terms & Conditions Section -->
        @php
        $termsServices = $contract->contractServices->filter(function($cs) {
        return $cs->service && $cs->service->type === 'terms';
        });
        @endphp

        @if($termsServices->count() > 0)
        <div class="specifications-section">
            <div class="specifications-title">TERMS & CONDITIONS:</div>
            @foreach($termsServices as $termsService)
            <div class="terms-service">
                <div class="terms-service-title">{{ $termsService->service->service }}:</div>
                @if($termsService->service->specifications && $termsService->service->specifications->count() > 0)
                @foreach($termsService->service->specifications as $specification)
                <div class="specification-item">{{ $specification->description }}</div>
                @endforeach
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- SEGUNDA PÁGINA -->
    <div class="page-break">
        <div class="second-page">
            <div class="content-container">
                <div class="bottom-section">
                    <!-- Fila superior con instrucciones y primera firma -->
                    <div class="top-row">
                        <div class="instructions-left">
                            <div class="instruction-text">
                                PLEASE SEND TWO COPIES OF YOUR WORK ORDER:
                            </div>
                            <div class="instruction-detail">
                                Enter this order in accordance with the prices, terms, and specifications listed above.
                            </div>
                        </div>
                        <div class="signature-right">
                            <div class="signature-label-top">Authorized by</div>
                            <div class="signature-line-horizontal"></div>
                        </div>
                    </div>

                    <!-- Fila media con SEND TO y segunda firma -->
                    <div class="middle-row">
                        <div class="send-to-left">
                            <div class="send-to-text">
                                SEND ALL CORRESPONDENCES TO:
                            </div>
                            <div class="company-info">
                                Prime Facility Services Group, Inc.<br>
                                8303 Westglen Drive<br>
                                Houston, TX 77063
                            </div>
                        </div>
                        <div class="signature-right">
                            <div class="signature-label-top">Print Name</div>
                            <div class="signature-line-horizontal"></div>
                        </div>
                    </div>

                    <!-- Fila inferior con contacto y tercera firma -->
                    <div class="bottom-row">
                        <div class="contact-left">
                            <div class="company-info">
                                customerservice@primefacilityservicesgroup.com<br>
                                (713) 338-2553 Phone<br>
                                (713) 574-3065 Fax
                            </div>
                        </div>
                        <div class="signature-right">
                            <div class="signature-label-top">Date</div>
                            <div class="signature-line-horizontal"></div>
                        </div>
                    </div>
                </div>

                <!-- Footer Página 2 -->
                <div class="page-footer">
                    <!-- Footer azul con información de contacto -->
                    <div style="background-color: #1c2969; padding: 15px; text-align: center; color: white; font-family: 'Inter', sans-serif; font-size: 14px; margin-top: 20px;">
                        8303 Westglen Drive ~ Houston, TX 77063 ~ Phone 713-338-2553 ~ Fax 713-574-3065<br>
                        www.primefacilityservicesgroup.com
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Global (solo para casos especiales) -->
    <div class="footer" style="display: none;">
        @php
        $footerImagePath = storage_path('app/public/imagenes/prime8.png');
        $footerImageData = '';
        if (file_exists($footerImagePath)) {
        $footerImageData = base64_encode(file_get_contents($footerImagePath));
        $footerImageMimeType = mime_content_type($footerImagePath);
        $footerImageDataUri = 'data:' . $footerImageMimeType . ';base64,' . $footerImageData;
        }
        @endphp

        @if(!empty($footerImageData))
        <img src="{{ $footerImageDataUri }}" alt="Prime Footer" class="footer-logo">
        @endif
    </div>

</body>

</html>