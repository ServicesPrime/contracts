<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Work Order</title>
    <style>
        @page {
            margin: 40px 40px;
        }

        body {
            font-family: Gotham, Arial, sans-serif;
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
            margin-left: 80px;
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
            width: 80%;
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
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>JOB WORK ORDER</h1>
        <p>"The Best Services in the Industry or Nothing at All"</p>
    </div>

    <!-- Content Container for Centering -->
    <div class="content-container">
        <!-- Three Columns Section -->
        <div class="three-columns">
            <div class="column">
                <span class="label">WORK SITE:</span>
                <span class="value">
                    {{ $contract->client->address->street ?? 'No street address' }}<br>
                    {{ $contract->client->address->city ?? '' }}{{ $contract->client->address->city && $contract->client->address->state ? ', ' : '' }}{{ $contract->client->address->state ?? '' }} {{ $contract->client->address->zip_code ?? '' }}<br>
                    {{ $contract->client->address->country ?? '' }}
                </span>
            </div>
            
            <div class="column">
                <span class="label">BILL TO:</span>
                <span class="value">
                    {{ $contract->client->name ?? 'No client name' }}<br>
                    <strong>Email:</strong> {{ $contract->client->email ?? 'No email' }}<br>
                    <strong>Phone:</strong> {{ $contract->client->phone ?? 'No phone' }}<br>
                    <strong>Area:</strong> {{ $contract->client->area ?? 'No area' }}
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
                    <span class="detail-label">WORK O. DATE:</span>
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

        <!-- Service Information -->
        <div class="specifications-section">
            <div class="specifications-title">
                SERVICE: {{ $contract->service->service ?? 'No service specified' }}
                @if($contract->service->type)
                    ({{ $contract->service->type === 'service' ? 'Service' : 'Terms & Conditions' }})
                @endif
            </div>
            
            @if($contract->service && $contract->service->specifications && count($contract->service->specifications) > 0)
                @foreach($contract->service->specifications as $specification)
                    <div class="specification-item">{{ $specification->description }}</div>
                @endforeach
            @else
                <div class="specification-item">No specifications available</div>
            @endif
        </div>

        <!-- Contract Table -->
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
                <tr>
                    <td>{{ $contract->client->address->city ?? 'No location' }}{{ $contract->client->address->city && $contract->client->address->state ? ', ' : '' }}{{ $contract->client->address->state ?? '' }}</td>
                    <td>{{ $contract->service->service ?? 'No service' }}</td>
                    <td>Monthly</td>
                    <td>{{ $contract->product_quantity }}</td>
                    <td>${{ number_format($contract->product_cost, 2) }}</td>
                    <td>${{ number_format($contract->product_cost * $contract->product_quantity, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>