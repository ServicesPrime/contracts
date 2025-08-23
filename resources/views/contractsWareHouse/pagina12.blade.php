{{-- C:\laragon\www\contracts\resources\views\contracts\pagina15.blade.php --}}
<!-- ====== PÁGINA 15 - EXHIBIT A / WAREHOUSE STAFFING ====== -->
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

    <!-- Contenido de la página -->
    <div style="position: relative; z-index: 2; padding: 40px 60px; text-align: center;">
        <!-- Encabezado principal -->
                  <h1 style="
            color: #b41f24;
            font-size: 32px;
            font-weight: bold;
            margin: 0 0 10px 0;
            letter-spacing: 1px;
        ">EXHIBIT A</h1>


        <h1 style="
            color: #b41f24;
            font-size: 32px;
            font-weight: bold;
            margin: 0 0 10px 0;
            letter-spacing: 1px;
        ">STAFFING SERVICES</h1>
        
        <h2 style="
            color: #b41f24;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 8px 0;
            letter-spacing: 0.5px;
        ">PROFESSIONAL PERSONNEL RATE SCHEDULE</h2>
       <p style="
    color: #162469ff;
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 8px 0;
    text-align: center;
">RATES BEFORE TAXES FOR:</p>

<p style="
    color: #162469ff;
    font-size: 20px;
    margin: 0 0 40px 0;
    font-weight: normal;
    text-align: center;
">111 Regal Row, Dallas, Tx. 75247</p>

<h3 class="titulo-centro" style="
   color: #b41f24;
   font-size: 24px;
   font-weight: bold;
   margin: 0 0 20px 0;
   letter-spacing: 1px;
   display: none;
">WAREHOUSE STAFFING</h3>



        <!-- Tabla -->
        <table style="
            width: 80%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 17px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin: 0 auto;
        ">
            <!-- Encabezado del título como fila separada -->
            <tr>
                <td style="
                    background-color: white;
                    border-right: 2px solid #b41f24;
                    border-top: none;
                    border-bottom: none;
                    padding: 22px 15px;
                    font-size: 20px;
                    color: #b41f24;
                    font-weight: bold;
                    text-align: center;
                ">WAREHOUSE STAFFING</td>

                <td style="
                    background-color: #b41f24;
                    color: white;
                    border: 2px solid #b41f24;
                    border-left: 2px solid #b41f24;
                    border-left: none;
                    border-bottom: none;
                    padding: 22px 12px;
                    text-align: center;
                    font-weight: bold;
                    width: 27.5%;
                    font-size: 18px;
                ">Option 1</td>
                <td style="
                    background-color: #b41f24;
                    color: white;
                    border: 2px solid #b41f24;
                    border-left: none;
                    border-bottom: none;
                    padding: 22px 12px;
                    text-align: center;
                    font-weight: bold;
                    width: 27.5%;
                    font-size: 18px;
                ">Option 2</td>
            </tr>
            <!-- Sub-encabezado -->
            <tr>
                <td style="
                    background-color: white;
                    border-right: 2px solid #b41f24;
                    border-bottom: 2px solid #b41f24;
                    border-top: none;
                    border-left: none;
                    padding: 0;
                    height: 0;
                "></td>
                <td style="
                    background-color: #b41f24;
                    color: white;
                    border: 2px solid #b41f24;
                    border-top: none;
                    border-left: none;
                    padding: 14px 12px;
                    text-align: center;
                    font-weight: bold;
                    font-size: 15px;
                ">Pay Rate Bill Rate</td>
                <td style="
                    background-color: #b41f24;
                    color: white;
                    border: 2px solid #b41f24;
                    border-top: none;
                    border-left: none;
                    padding: 14px 12px;
                    text-align: center;
                    font-weight: bold;
                    font-size: 15px;
                ">Pay Rate Bill Rate</td>
            </tr>
            <!-- Filas de datos -->
            <tr>
                <td style="
                    background-color: white;
                    border-right: 2px solid #b41f24;
                    border-bottom: 2px solid #b41f24;
                    border-top: none;
                    border-left: 2px solid #b41f24;
                    padding: 20px 15px;
                    font-weight: normal;
                    font-size: 17px;
                ">Loading and Unloading Worker</td>
                <td style="
                    background-color: white;
                    border: 2px solid #b41f24;
                    border-top: none;
                    border-left: 2px solid #b41f24;
                    padding: 20px 12px;
                    text-align: center;
                    color: #b41f24;
                    font-weight: bold;
                    font-size: 17px;
                ">$16.00 &nbsp;&nbsp; $20.80</td>
                <td style="
                    background-color: white;
                    border: 2px solid #b41f24;
                    border-top: none;
                    border-left: 2px solid #b41f24;
                    padding: 20px 12px;
                    text-align: center;
                    color: #b41f24;
                    font-weight: bold;
                    font-size: 17px;
                ">$15.50 &nbsp;&nbsp; $19.50</td>
            </tr>
            <tr>
                <td style="
                    background-color: white;
                    border-right: 2px solid #b41f24;
                    border-bottom: 2px solid #b41f24;
                    border-top: none;
                    border-left: 2px solid #b41f24;
                    padding: 20px 15px;
                    font-weight: normal;
                    font-size: 17px;
                ">Picking and Packing Staff</td>
                <td style="
                    background-color: white;
                    border: 2px solid #b41f24;
                    border-top: none;
                   border-left: 2px solid #b41f24;
                    padding: 20px 12px;
                    text-align: center;
                    color: #b41f24;
                    font-weight: bold;
                    font-size: 17px;
                ">$15.00 &nbsp;&nbsp; $19.50</td>
                <td style="
                    background-color: white;
                    border: 2px solid #b41f24;
                    border-top: none;
                    border-left: 2px solid #b41f24;
                    padding: 20px 12px;
                    text-align: center;
                    color: #b41f24;
                    font-weight: bold;
                    font-size: 17px;
                ">$14.75 &nbsp;&nbsp; $19.20</td>
            </tr>
            <tr>
                <td style="
                    background-color: white;
                    border-right: 2px solid #b41f24;
                    border-bottom: 2px solid #b41f24;
                    border-top: none;
                    border-left: 2px solid #b41f24;
                    padding: 20px 15px;
                    font-weight: normal;
                    font-size: 17px;
                ">Temporary Staff</td>
                <td style="
                    background-color: white;
                    border: 2px solid #b41f24;
                    border-top: none;
                  border-left: 2px solid #b41f24;
                    padding: 20px 12px;
                    text-align: center;
                    color: #b41f24;
                    font-weight: bold;
                    font-size: 17px;
                ">$15.00 &nbsp;&nbsp; $19.50</td>
                <td style="
                    background-color: white;
                    border: 2px solid #b41f24;
                    border-top: none;
                    border-left: 2px solid #b41f24;
                    padding: 20px 12px;
                    text-align: center;
                    color: #b41f24;
                    font-weight: bold;
                    font-size: 17px;
                ">$14.75 &nbsp;&nbsp; $19.20</td>
            </tr>
        </table>
        </table>
    </div>

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 15 }}</div>
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
<!-- ====== FIN PÁGINA 15 ====== -->