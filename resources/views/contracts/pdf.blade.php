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
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #b91f32;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .logo {
            width: 130px;
        }

        .title-block {
            text-align: right;
        }

        .title-block h1 {
            margin: 0;
            font-size: 20px;
            color: #b91f32;
        }

        .title-block p {
            font-size: 10px;
            margin: 2px 0 0 0;
            color: #666;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .info-box {
            width: 32%;
        }

        .info-box strong {
            color: #b91f32;
            display: block;
            margin-bottom: 4px;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .details div {
            width: 32%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-top: 5px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
        }

        th {
            background-color: #f5f5f5;
            color: #b91f32;
            text-align: left;
        }

        .section-title {
            font-weight: bold;
            color: #b91f32;
            font-size: 12px;
            margin: 15px 0 5px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
        }

        ul {
            padding-left: 15px;
            margin: 4px 0;
        }

        ul li {
            margin-bottom: 3px;
        }

        .footer {
            font-size: 9px;
            text-align: center;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('storage/prime.png') }}" class="logo" alt="Logo">
        <div class="title-block">
            <h1>WORK ORDER</h1>
            <p>“The Best Services in the Industry or Nothing at All”</p>
        </div>
    </div>

    <!-- Top Info -->
    <div class="info-section">
        <div class="info-box">
            <strong>WORK SITE:</strong>
            1 Potomac Drive,<br>
            Houston, TX 77057
        </div>
        <div class="info-box">
            <strong>BILL TO:</strong>
            David Cardoso<br>
            Executive Steward<br>
            1 Potomac Drive, Houston, TX 77057<br>
            O) 713.465.8381 ext. 247<br>
            www.houstoncc.com
        </div>
        <div class="info-box">
            <strong>WORK ORDER NUMBER:</strong>
            {{ $contract->contract_number }}
        </div>
    </div>

    <!-- Details -->
    <div class="details">
        <div><strong>REQUESTED BY:</strong> David Cardoso</div>
        <div><strong>DEPARTMENT:</strong> Facilities</div>
        <div><strong>INVOICE #:</strong> {{ $contract->invoice_number ?? '0000000000' }} | <strong>TERMS:</strong> 15</div>
    </div>

    <!-- Table -->
    <table>
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
                <td>{{ $contract->location }}</td>
                <td>{{ $contract->product_description }}</td>
                <td>Monthly</td>
                <td>{{ $contract->product_quantity }}</td>
                <td>${{ number_format($contract->product_cost, 2) }}</td>
                <td>${{ number_format($contract->product_cost * $contract->product_quantity, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Service Specifications -->
    <div class="section-title">SERVICE SPECIFICATIONS:</div>
    <ul>
        <li>Complete hood system cleaning to bare metal in accordance with NFPA-96 standards</li>
        <li>Filter removal, cleaning, and reinstallation</li>
        <li>Ductwork and vertical riser cleaning</li>
        <li>Exhaust fan cleaning and inspection</li>
        <li>Special attention to UV systems where applicable</li>
        <li>Specialized cleaning for wood burning equipment areas</li>
        <li>Ventless hood systems receive comprehensive cleaning of all components</li>
        <li>Photo documentation before and after service</li>
        <li>Detailed service report provided</li>
    </ul>

    <!-- Terms and Conditions -->
    <div class="section-title">TERMS & CONDITIONS:</div>
    <strong>Area Preparation:</strong>
    <ul>
        <li>All cooking equipment shut down 2 hours before service</li>
        <li>Clear access to all hood systems and related components</li>
        <li>Airport security clearance arranged for service team</li>
    </ul>
    <strong>Service Limitations:</strong>
    <ul>
        <li>Work to be performed during approved service windows</li>
        <li>Additional charges may apply for emergency service requests</li>
        <li>Separate scheduling required for wood burning equipment areas</li>
    </ul>
    <strong>Cancellation Policy:</strong>
    <ul>
        <li>48-hour notice required for cancellation</li>
        <li>Cancellations within 48 hours incur a 25% fee</li>
    </ul>

    <!-- Footer -->
    <div class="footer">
        8303 Westglen Drive ~ Houston, TX 77063 ~ Phone 713-338-2553 ~ Fax 713-574-3065 ~ www.primefacilityservicesgroup.com
    </div>
</body>
</html>
