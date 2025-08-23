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

     @include('contractsSchool.portada', ['logo64' => $logo64, 'bldg64' => $bldg64]) 
     @include('contractsSchool.paginathankyou', ['logo64' => $logo64, 'bldg64' => $bldg64])
    @include('contractsSchool.pagina1', ['pageNumber' => 1])
    @include('contractsSchool.pagina2', ['pageNumber' => 2])
    @include('contractsSchool.pagina3', ['pageNumber' => 3])
    @include('contractsSchool.pagina4', ['pageNumber' => 4])
    @include('contractsSchool.pagina5', ['pageNumber' => 5])
    @include('contractsSchool.pagina6', ['pageNumber' => 6])
    @include('contractsSchool.pagina7', ['pageNumber' => 7])
    @include('contractsSchool.pagina8', ['pageNumber' => 8])
    @include('contractsSchool.pagina9', ['pageNumber' => 9])
    @include('contractsSchool.pagina10', ['pageNumber' => 10])
    @include('contractsSchool.pagina11', ['pageNumber' => 11])
    @include('contractsSchool.pagina12', ['pageNumber' => 12])    
    @include('contractsSchool.pagina13', ['pageNumber' => 13])
    @include('contractsSchool.pagina14', ['pageNumber' => 14])
    @include('contractsSchool.pagina15', ['pageNumber' => 15])
    @include('contractsSchool.pagina16', ['pageNumber' => 16])
    @include('contractsSchool.pagina17', ['pageNumber' => 17])
    @include('contractsSchool.pagina18', ['pageNumber' => 18])
    @include('contractsSchool.pagina19', ['pageNumber' => 19])
    @include('contractsSchool.pagina20', ['pageNumber' => 20])
    @include('contractsSchool.pagina21', ['pageNumber' => 21])
    @include('contractsSchool.pagina22', ['pageNumber' => 22])
    @include('contractsSchool.pagina23', ['pageNumber' => 23])
    @include('contractsSchool.pagina24', ['pageNumber' => 24])
    @include('contractsSchool.pagina25', ['pageNumber' => 25])
    @include('contractsSchool.pagina26', ['pageNumber' => 26]) 
</html>