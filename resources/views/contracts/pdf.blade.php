{{-- C:\laragon\www\contracts\resources\views\contracts\pdf.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contract Document</title>
    @include('contracts.styles')
</head>
<body>
@php
// Ruta absoluta en el servidor usando storage_path()
$logoPath = storage_path('app/public/Prime.png');
$bldgPath = storage_path('app/public/Edificio.png');

// Convertir a base64 si existen
$logo64 = file_exists($logoPath) 
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) 
    : '';
$bldg64 = file_exists($bldgPath) 
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($bldgPath)) 
    : '';
@endphp

    {{-- Incluir la portada (sin número de página) --}}
    @include('contracts.portada', ['logo64' => $logo64, 'bldg64' => $bldg64])
    
    {{-- Incluir página 1 --}}
    @include('contracts.pagina1', ['pageNumber' => 1])
    
    {{-- Incluir página 2 --}}
    @include('contracts.pagina2', ['pageNumber' => 2])
    
    {{-- Incluir página 3 --}}
    @include('contracts.pagina3', ['pageNumber' => 3])
    
    {{-- Incluir página 4 --}}
    @include('contracts.pagina4', ['pageNumber' => 4])
    
    {{-- Incluir página 5 - NOTICES --}}
    @include('contracts.pagina5', ['pageNumber' => 5])
    
    {{-- Incluir página 6 --}}
    @include('contracts.pagina6', ['pageNumber' => 6])
    
    {{-- Incluir página 7 --}}
    @include('contracts.pagina7', ['pageNumber' => 7])
    
    {{-- Incluir página 8 --}}
    @include('contracts.pagina8', ['pageNumber' => 8])
    
    {{-- Incluir página 9 - INITIAL DEEP CLEANING SERVICE --}}
    @include('contracts.pagina9', ['pageNumber' => 9])
    
    {{-- Incluir página 10 - EXHIBIT A / OVERNIGHT KITCHEN CLEANING --}}
    @include('contracts.pagina10', ['pageNumber' => 10])
    
    {{-- Incluir página 11 - EXHIBIT B: BENEFITS WAIVER --}}
    @include('contracts.pagina11', ['pageNumber' => 11])
    
    {{-- Incluir página 12 - EXHIBIT C: CONFIDENTIALITY AGREEMENT --}}
    @include('contracts.pagina12', ['pageNumber' => 12])
    
    {{-- Incluir página 13 - TECHNICAL ANNEX --}}
    @include('contracts.pagina13', ['pageNumber' => 13])
    
    {{-- Incluir página 14 - OPTIONAL PROVISIONS --}}
    @include('contracts.pagina14', ['pageNumber' => 14])
    
    {{-- Incluir página 15 - CONTINUACIÓN --}}
    @include('contracts.pagina15', ['pageNumber' => 15])
    
    {{-- Incluir página 16 - PÁGINA FINAL DEL CONTRATO --}}
    @include('contracts.pagina16', ['pageNumber' => 16])
    
    {{-- Incluir página 17 - SERVICE AREAS --}}
    @include('contracts.pagina17', ['pageNumber' => 17])
    
    {{-- Incluir página 18 - SCOPE OF WORK --}}
    @include('contracts.pagina18', ['pageNumber' => 18])
    
    {{-- Incluir página 19 - ADDITIONAL STAFF SERVICES --}}
    @include('contracts.pagina19', ['pageNumber' => 19])
    
    {{-- Incluir página 20 - ADDITIONAL STAFF SERVICES (CONTINUED) --}}
    @include('contracts.pagina20', ['pageNumber' => 20])
    
    {{-- Incluir página 21 - SERVICE AREAS (si existe) --}}
    @include('contracts.pagina21', ['pageNumber' => 21])
    
    {{-- Incluir página 22 - BUDGET BREAKDOWN --}}
    @include('contracts.pagina22', ['pageNumber' => 22])
    
    {{-- Incluir página 23 - DETAILED COST BREAKDOWN --}}
    @include('contracts.pagina23', ['pageNumber' => 23])
    
    {{-- Incluir página 24 - COST DISTRIBUTION ANALYSIS --}}
    @include('contracts.pagina24', ['pageNumber' => 24])
    
</body>
</html>