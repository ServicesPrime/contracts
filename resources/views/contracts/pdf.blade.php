<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Order - {{ $contract->contract_number }}</title>
    <style>
        @page {
            margin: 40px 40px;
            size: A4;
        }

        body {
            font-family: "Gotham", Arial, sans-serif;
            font-size: 20px;
            color: #333;
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
            font-family: "Gotham", Arial, sans-serif;
            font-size: 50px;
            color: #b91f32;
            margin: 0;
            font-weight: bold;
            line-height: 1;
        }

        .header-text p {
            font-family: "Gotham", Arial, sans-serif;
            font-size: 26px;
            color: #333;
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
        }

        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .info-left, .info-center, .info-right {
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
        }

        .value {
            color: #333;
            font-size: 20px;
            line-height: 1.3;
            margin-bottom: 8px;
        }

        .work-order-number {
            color: #b91f32;
            font-weight: bold;
            font-size: 20px;
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
            margin-bottom: 20px;
            font-size: 20px;
        }

        .contract-table th {
            background-color: #b91f32;
            color: white;
            padding: 6px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border: 1px solid #b91f32;
        }

        .contract-table td {
            border: 1px solid #b91f32;
            padding: 6px;
            text-align: center;
            background-color: white;
            font-size: 20px;
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
        }

        .spec-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .spec-item {
            color: #333;
            font-size: 10px;
            margin-bottom: 3px;
            padding-left: 12px;
            position: relative;
        }

        .spec-item:before {
            content: "•";
            color: #b91f32;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        .terms-section {
            margin-top: 15px;
        }

        .terms-subsection {
            margin-bottom: 12px;
        }

        .terms-subtitle {
            color: #333;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .terms-item {
            color: #333;
            font-size: 20px;
            margin-bottom: 2px;
            padding-left: 12px;
            position: relative;
        }

        .terms-item:before {
            content: "•";
            color: #333;
            position: absolute;
            left: 0;
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

        .three-columns {
            width: 100%;
            display: table;
            table-layout: fixed;
            margin-bottom: 20px;
        }

        .column {
            display: table-cell;
            width: 33.33%;
            vertical-align: top;
            padding-right: 20px;
        }

        .column:last-child {
            padding-right: 0;
        }

        .work-order-text {
            font-size: 20px;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .work-order-label {
            color: #b91f32;
            font-weight: bold;
            font-size: 20px;
            display: block;
            margin-bottom: 5px;
        }

        .work-order-value {
            color: #b91f32;
            font-weight: bold;
            font-size: 20px;
            display: block;
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
        }

        .detail-value {
            color: #333;
            font-size: 10px;
            display: block;
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
        }

        .bottom-value {
            color: #333;
            font-size: 10px;
            display: block;
        }

        .specifications-title {
            color: #b91f32;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #b91f32;
            padding-bottom: 5px;
        }

        .specification-item {
            color: #333;
            font-size: 10px;
            margin-bottom: 5px;
            padding-left: 15px;
            position: relative;
        }

        .specification-item:before {
            content: "•";
            color: #b91f32;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        .terms-service {
            margin-bottom: 15px;
        }

        .terms-service-title {
            color: #333;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

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
                            <strong>{{ $contract->client->address->name_account }}</strong><br>
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
                        <strong>{{ $contract->client->name }}</strong><br>
                        <strong>Email:</strong> {{ $contract->client->email ?? 'N/A' }}<br>
                        <strong>Phone:</strong> {{ $contract->client->phone ?? 'N/A' }}<br>
                        @if($contract->client->area)
                            <strong>Area:</strong> {{ $contract->client->area }}
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
            <div class="details-row">
                <div class="detail-cell">
                    <span class="detail-label">WORK DATE:</span>
                    <span class="detail-value">{{ $contract->date ? \Carbon\Carbon::parse($contract->date)->format('m/d/Y') : 'N/A' }}</span>
                </div>
                <div class="detail-cell">
                    <span class="detail-label">REQUESTED BY:</span>
                    <span class="detail-value">{{ $contract->client->name ?? 'N/A' }}</span>
                </div>
                <div class="detail-cell">
                    <span class="detail-label">DEPARTMENT:</span>
                    <span class="detail-value">{{ $contract->department ?? 'N/A' }}</span>
                </div>
            </div>
            
            <div class="bottom-row">
                <div class="bottom-cell">
                    <span class="bottom-label">INVOICE # FOR BILL:</span>
                    <span class="bottom-value">{{ $contract->contract_number }}</span>
                </div>
                <div class="bottom-cell">
                    <span class="bottom-label">TERMS:</span>
                    <span class="bottom-value">15</span>
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

    <!-- Footer -->
    <div class="footer">
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