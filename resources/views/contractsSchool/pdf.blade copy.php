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

    Incluir la portada (sin número de página) 
    @include('contracts.portada', ['logo64' => $logo64, 'bldg64' => $bldg64])
    @include('contracts.paginathankyou', ['logo64' => $logo64, 'bldg64' => $bldg64])
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
    @include('contracts.pagina14', ['pageNumber' => 14])
    @include('contracts.pagina15', ['pageNumber' => 15])
    @include('contracts.pagina16', ['pageNumber' => 16])
    @include('contracts.pagina17', ['pageNumber' => 17])
    @include('contracts.pagina18', ['pageNumber' => 18])
    @include('contracts.pagina19', ['pageNumber' => 19])
    @include('contracts.pagina20', ['pageNumber' => 20])
    @include('contracts.pagina21', ['pageNumber' => 21])
    @include('contracts.pagina22', ['pageNumber' => 22])
    @include('contracts.pagina23', ['pageNumber' => 23])
    @include('contracts.pagina24', ['pageNumber' => 24])
    @include('contracts.pagina25', ['pageNumber' => 25])      
    @include('contracts.pagina26', ['pageNumber' => 26])     
    
</body>
</html>