<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Order - {{ $contract->contract_number ?? 'null' }}</title>

    <style>
        @page {
            margin: 40px 40px;
            size: A4;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 20px;
            color: #1c2969;
            margin: 0;
            padding: 0;
            line-height: 1.3;
        }

        .content-container {
            width: 95%;
            margin: 0 auto;
            font-size: 20px;
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

        .column:last-child {
            padding-right: 0;
        }

        .label {
            color: #b91f32;
            font-weight: bold;
            margin-bottom: 3px;
            display: block;
        }

        .value {
            color: #1c2969;
            margin-bottom: 8px;
        }

        .work-order-text {
            color: #1c2969;
            margin-bottom: 5px;
        }

        .work-order-label {
            color: #b91f32;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .work-order-value {
            color: #b91f32;
            font-weight: bold;
            display: block;
        }

        .details-grid {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .single-details-row {
            width: 100%;
            display: table;
            table-layout: fixed;
        }

        .single-detail-cell {
            display: table-cell;
            width: 20%;
            vertical-align: top;
            padding-right: 15px;
        }

        .single-detail-cell:last-child {
            padding-right: 0;
        }

        .detail-label {
            color: #b91f32;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #1c2969;
            display: block;
        }

        .contract-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .contract-table th {
            background-color: #b91f32;
            color: white;
            padding: 6px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #b91f32;
        }

        .contract-table td {
            border: 1px solid #b91f32;
            padding: 6px;
            text-align: center;
            background-color: white;
        }

        .specifications-section {
            margin-bottom: 15px;
        }

        .specifications-title {
            color: #b91f32;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .specification-item {
            color: #1c2969;
            margin-bottom: 3px;
            padding-left: 12px;
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
            color: #1c2969;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .terms-service .specification-item {
            font-size: 18px;
        }

        .page-break {
            page-break-before: always;
            break-before: page;
        }

        /* Segunda página */
        .second-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding-top: 100px;
            padding-bottom: 120px;
        }

        .bottom-section {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .instruction-text,
        .send-to-text {
            color: #b91f32;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 8px;
        }

        .instruction-detail,
        .company-info {
            color: #1c2969;
            font-size: 18px;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        .signature-label-top {
            color: #1c2969;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 12px;
            text-align: right;
        }

        .signature-line-horizontal {
            border-bottom: 2px solid #b91f32;
            height: 50px;
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- PRIMERA PÁGINA -->
    <div class="content-container">
        <!-- Three Columns Section -->
        <div class="three-columns">
            <div class="column">
                <span class="label">WORK SITE:</span>
                <span class="value">
                    @if(isset($contract->client->address))
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
                        null
                    @endif
                </span>
            </div>

            <div class="column">
                <span class="label">BILL TO:</span>
                <span class="value">
                    @if(isset($contract->client))
                        {{ $contract->client->name ?? 'null' }}<br>
                        {{ $contract->client->email ?? 'null' }}<br>
                        {{ $contract->client->phone ?? 'null' }}
                        @if(isset($contract->client->area))
                            <br>{{ $contract->client->area }}
                        @endif
                    @else
                        null
                    @endif
                </span>
            </div>

            <div class="column">
                <div class="work-order-text">
                    The following number must appear on all related correspondence, shipping papers, and invoices:
                </div>
                <span class="work-order-label">WORK ORDER NUMBER:</span>
                <span class="work-order-value">{{ $contract->contract_number ?? 'null' }}</span>
            </div>
        </div>

        <!-- Details Section -->
        <div class="details-grid">
            <div class="single-details-row">
                <div class="single-detail-cell">
                    <span class="detail-label">WORK DATE:</span>
                    <span class="detail-value">
                        @if(isset($contract->date))
                            {{ \Carbon\Carbon::parse($contract->date)->format('m/d/Y') }}
                        @else
                            null
                        @endif
                    </span>
                </div>
                <div class="single-detail-cell">
                    <span class="detail-label">REQUESTED BY:</span>
                    <span class="detail-value">
                        @if(isset($contract->client->name))
                            {{ $contract->client->name }}
                        @elseif(isset($client->name))
                            {{ $client->name }}
                        @else
                            null
                        @endif
                    </span>
                </div>
                <div class="single-detail-cell">
                    <span class="detail-label">DEPARTMENT:</span>
                    <span class="detail-value">{{ $contract->department ?? 'null' }}</span>
                </div>
                <div class="single-detail-cell">
                    <span class="detail-label">INVOICE:</span>
                    <span class="detail-value">{{ $contract->contract_number ?? 'null' }}</span>
                </div>
                <div class="single-detail-cell">
                    <span class="detail-label">TERMS:</span>
                    <span class="detail-value">15</span>
                </div>
            </div>
        </div>

        <!-- Contract Services Table -->
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
                @if(isset($paidServices) && $paidServices->count() > 0)
                    @foreach($paidServices as $contractService)
                    <tr>
                        <td>
                            @if(isset($contract->client->address->city))
                                {{ $contract->client->address->city }}
                            @else
                                null
                            @endif
                        </td>
                        <td>
                            @if(isset($contractService->service->service))
                                {{ $contractService->service->service }}
                            @else
                                null
                            @endif
                        </td>
                        <td>Monthly</td>
                        <td>{{ $contractService->quantity ?? 'null' }}</td>
                        <td>${{ number_format($contractService->unit_price ?? 0, 2) }}</td>
                        <td>${{ number_format(($contractService->quantity ?? 0) * ($contractService->unit_price ?? 0), 2) }}</td>
                    </tr>
                    @endforeach
                    <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td colspan="5" style="text-align: right;">TOTAL AMOUNT:</td>
                        <td>${{ number_format($totalAmount ?? 0, 2) }}</td>
                    </tr>
                @else
                    <tr>
                        <td>null</td>
                        <td>null</td>
                        <td>Monthly</td>
                        <td>null</td>
                        <td>$0.00</td>
                        <td>$0.00</td>
                    </tr>
                    <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td colspan="5" style="text-align: right;">TOTAL AMOUNT:</td>
                        <td>$0.00</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Service Specifications Section -->
        <div class="specifications-section">
            <div class="specifications-title">SERVICE SPECIFICATIONS:</div>
            @if(isset($serviceSpecifications) && $serviceSpecifications->count() > 0)
                @foreach($serviceSpecifications as $specification)
                <div class="specification-item">{{ $specification->description ?? 'null' }}</div>
                @endforeach
            @else
                <div class="specification-item">null</div>
            @endif
        </div>

        <!-- Terms & Conditions Section -->
        <div class="specifications-section">
            <div class="specifications-title">TERMS & CONDITIONS:</div>
            @if(isset($termsServices) && $termsServices->count() > 0)
                @foreach($termsServices as $termsService)
                <div class="terms-service">
                    <div class="terms-service-title">
                        @if(isset($termsService->service->service))
                            {{ $termsService->service->service }}:
                        @else
                            null:
                        @endif
                    </div>
                    @if(isset($termsService->service->specifications))
                        @foreach($termsService->service->specifications as $specification)
                        <div class="specification-item">{{ $specification->description ?? 'null' }}</div>
                        @endforeach
                    @else
                        <div class="specification-item">null</div>
                    @endif
                </div>
                @endforeach
            @else
                <div class="terms-service">
                    <div class="terms-service-title">null:</div>
                    <div class="specification-item">null</div>
                </div>
            @endif
        </div>
    </div>

    <!-- SEGUNDA PÁGINA -->
    <div class="page-break">
        <div class="second-page">
            <div class="content-container">
                <div class="bottom-section">
                    <div class="instruction-text">
                        PLEASE SEND TWO COPIES OF YOUR WORK ORDER:
                    </div>
                    <div class="instruction-detail">
                        Enter this order in accordance with the prices, terms, and specifications listed above.
                    </div>

                    <div class="send-to-text">
                        SEND ALL CORRESPONDENCES TO:
                    </div>
                    <div class="company-info">
                        Prime Facility Services Group, Inc.<br>
                        8303 Westglen Drive<br>
                        Houston, TX 77063
                    </div>

                    <div class="signature-label-top">Authorized by</div>
                    <div class="signature-line-horizontal"></div>

                    <div class="signature-label-top">Print Name</div>
                    <div class="signature-line-horizontal"></div>

                    <div class="signature-label-top">Date</div>
                    <div class="signature-line-horizontal"></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>