
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

{{-- @include('contracts.cover.janitorial.cover', ['logo64' => $logo64, 'bldg64' => $bldg64]) --}}
@include('contracts.thankyou', ['logo64' => $logo64, 'bldg64' => $bldg64])

</body>
</html>