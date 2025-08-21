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

   
    @include('contracts.portada', ['logo64' => $logo64, 'bldg64' => $bldg64])
    @include('contracts.pagina1', ['pageNumber' => 1])
    @include('contracts.pagina2', ['pageNumber' => 2])
    @include('contracts.pagina3', ['pageNumber' => 3])
    @include('contracts.pagina4', ['pageNumber' => 4])
    @include('contracts.pagina5', ['pageNumber' => 5])
    @include('contracts.pagina6', ['pageNumber' => 6])
    @include('contracts.pagina7', ['pageNumber' => 7])
    @include('contracts.pagina8', ['pageNumber' => 8])
    @include('contracts.pagina9', ['pageNumber' => 9])
    @include('contracts.pagina10', ['pageNumber' => 10])
    @include('contracts.pagina11', ['pageNumber' => 11])
     @include('contracts.pagina12', ['pageNumber' => 12]) 
    @include('contracts.pagina13', ['pageNumber' => 13])
    @include('contracts.pagina44', ['pageNumber' => 14])
    @include('contracts.pagina45', ['pageNumber' => 15])
    
    
   
    
     {{-- @include('contracts.pagina8', ['pageNumber' => 8]) --}}
</body>
</html>