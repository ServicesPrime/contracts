{{-- C:\laragon\www\contracts\resources\views\contracts\pagina14.blade.php --}}

<!-- ====== PÁGINA 14 - SCOPE OF WORK ====== -->
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
    <div class="page-number">{{ $pageNumber ?? 8 }}</div>


 <div class="content content-with-padding" style="position: relative; z-index: 2; text-align: left;">
        
    <h1 class="service-areas-title">SCOPE OF WORK</h1>

     <h2>Services Areas:</h2>
    <div style="margin-bottom: 30px;">
       
        <ul style="margin-top: 5px; margin-left: 20px;">
            <li style="color: #162469ff; font-weight: bold; font-size: 12pt;">Warehouse</li>
        </ul>
    </div>

    <h2>Loading and Unloading Worker</h2>
    <p>
        Responsible for assisting in the safe and efficient loading and unloading of trucks, containers, and pallets. Tasks include:
    </p>
    <ul style="margin-bottom: 25px;">
        <li>Handling inbound and outbound shipments.</li>
        <li>Ensuring proper placement of goods in designated areas.</li>
        <li>Following safety protocols to prevent accidents and product damage.</li>
    </ul>

    <h2>Picking and Packing Staff</h2>
    <p>
        Dedicated to the preparation of orders by selecting, organizing, and packing goods according to client requirements. Tasks include:
    </p>
    <ul style="margin-bottom: 25px;">
        <li>Order picking from racks and shelves.</li>
        <li>Packing, labeling, and preparing shipments.</li>
        <li>Verifying accuracy and completeness of orders before dispatch.</li>
    </ul>

    <h2>Temporary Staff</h2>
    <p>
        Flexible personnel available to support warehouse operations as needed. Tasks include:
    </p>
    <ul style="margin-bottom: 25px;">
        <li>Assisting in peak workload periods.</li>
        <li>Covering absences or special projects.</li>
        <li>Performing general support tasks across warehouse operations.</li>
    </ul>
    
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
<!-- ====== FIN PÁGINA 14 ====== -->