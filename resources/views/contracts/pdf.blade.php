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
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #b91f32;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
            color: #b91f32;
            font-weight: bold;
        }

        .header p {
            font-size: 10px;
            margin: 5px 0 0 0;
            color: #666;
        }

        .content-container {
            width: 90%;
            margin: 0 auto;
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

        .label {
            color: #b91f32;
            font-size: 12px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .value {
            color: #333;
            font-size: 10px;
            display: block;
            line-height: 1.3;
        }

        .work-order-text {
            font-size: 10px;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .work-order-label {
            color: #b91f32;
            font-weight: bold;
            font-size: 12px;
            display: block;
            margin-bottom: 5px;
        }

        .work-order-value {
            color: #b91f32;
            font-weight: bold;
            font-size: 12px;
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
            font-size: 12px;
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
            font-size: 12px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .bottom-value {
            color: #333;
            font-size: 10px;
            display: block;
        }

        .contract-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 10px;
        }

        .contract-table th {
            background-color: #b91f32;
            color: white;
            padding: 8px;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }

        .contract-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
            background-color: white;
        }

        .contract-table tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .specifications-section {
            margin-top: 20px;
        }

        .specifications-title {
            color: #b91f32;
            font-size: 12px;
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

        .terms-section {
            margin-top: 20px;
        }

        .terms-service {
            margin-bottom: 15px;
        }

        .terms-service-title {
            color: #333;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>JOB WORK ORDER</h1>
        <p>"The Best Services in the Industry or Nothing at All"</p>
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
                        @if($contract->client->address->city || $contract->client->address->state)
                            {{ collect([$contract->client->address->city, $contract->client->address->state, $contract->client->address->zip_code])->filter()->implode(', ') }}<br>
                        @endif
                        @if($contract->client->address->country)
                            {{ $contract->client->address->country }}<br>
                        @endif
                        @if($contract->client->address->full_address && !$contract->client->address->street)
                            {{ $contract->client->address->full_address }}
                        @endif
                    @else
                        No address available
                    @endif
                </span>
            </div>
            
            <div class="column">
                <span class="label">BILL TO:</span>
                <span class="value">
                    <strong>{{ $contract->client->name ?? 'No client name' }}</strong><br>
                    <strong>Email:</strong> {{ $contract->client->email ?? 'No email' }}<br>
                    <strong>Phone:</strong> {{ $contract->client->phone ?? 'No phone' }}<br>
                    @if($contract->client->area)
                        <strong>Area:</strong> {{ $contract->client->area }}
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
                    <span class="detail-value">{{ \Carbon\Carbon::parse($contract->date)->format('m/d/Y') }}</span>
                </div>
                <div class="detail-cell">
                    <span class="detail-label">REQUESTED BY:</span>
                    <span class="detail-value">{{ $contract->client->name ?? 'No client name' }}</span>
                </div>
                <div class="detail-cell">
                    <span class="detail-label">DEPARTMENT:</span>
                    <span class="detail-value">{{ $contract->department }}</span>
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
            $paidServices = $contract->contractServices->filter(function($contractService) {
                return $contractService->service && $contractService->service->type === 'service';
            });
            
            $totalAmount = $paidServices->sum(function($contractService) {
                return $contractService->quantity * $contractService->unit_price;
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
                                {{ collect([$contract->client->address->city ?? '', $contract->client->address->state ?? ''])->filter()->implode(', ') ?: 'No location' }}
                            </td>
                            <td>{{ $contractService->service->service ?? 'No service' }}</td>
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
            $allSpecifications = collect();
            foreach($contract->contractServices as $contractService) {
                if($contractService->service && $contractService->service->type === 'service' && $contractService->service->specifications) {
                    $allSpecifications = $allSpecifications->merge($contractService->service->specifications);
                }
            }
            $uniqueSpecifications = $allSpecifications->unique('description');
        @endphp

        @if($uniqueSpecifications->count() > 0)
            <div class="specifications-section">
                <div class="specifications-title">SERVICE SPECIFICATIONS:</div>
                @foreach($uniqueSpecifications as $specification)
                    <div class="specification-item">{{ $specification->description }}</div>
                @endforeach
            </div>
        @endif

        <!-- Terms & Conditions Section -->
        @php
            $termsServices = $contract->contractServices->filter(function($contractService) {
                return $contractService->service && $contractService->service->type === 'terms';
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

</body>
</html>