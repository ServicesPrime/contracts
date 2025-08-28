
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

@include('contracts.cover.janitorial.cover', ['logo64' => $logo64, 'bldg64' => $bldg64]) 
@include('contracts.thankyou', ['logo64' => $logo64, 'bldg64' => $bldg64]) 
@include('contracts.pagina1')
@include('contracts.pagina2')
@include('contracts.pagina3')
@include('contracts.pagina4')
@include('contracts.pagina5')
@include('contracts.pagina6')
@include('contracts.pagina7')
@include('contracts.pagina8')
@include('contracts.pagina9')
@include('contracts.pagina10')  
@include('contracts.pagina11') 
@include('contracts.pagina12') 
@include('contracts.pagina13') 
@include('contracts.pagina16')
@include('contracts.pagina19')
@include('contracts.pagina20')

</body>
</html>