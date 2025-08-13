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
    // Rutas absolutas a las imágenes
    $logoPath = 'C:\laragon\www\contracts\storage\app\public\Prime.png';
    $bldgPath = 'C:\laragon\www\contracts\storage\app\public\Edificio.png';
    
    // Convertir a base64 si existen
    $logo64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';
    $bldg64 = file_exists($bldgPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($bldgPath)) : '';
    @endphp

    {{-- Incluir la portada --}}
    @include('contracts.portada', ['logo64' => $logo64, 'bldg64' => $bldg64])
    
    {{-- Incluir página 1 --}}
    @include('contracts.pagina1')
    
    {{-- Incluir página 2 --}}
    @include('contracts.pagina2')
    
    {{-- Incluir página 3 --}}
    @include('contracts.pagina3')
    
    {{-- Incluir página 4 --}}
    @include('contracts.pagina4')
    
    {{-- Incluir página 5 --}}
    @include('contracts.pagina5')
    
    {{-- Incluir página 6 --}}
    @include('contracts.pagina6')
    
    {{-- Incluir página 7 --}}
    @include('contracts.pagina7')
    
    {{-- Incluir página 8 --}}
    @include('contracts.pagina8')
    
    {{-- Incluir página 9 --}}
    @include('contracts.pagina9')
    
    {{-- Incluir página 10 --}}
    @include('contracts.pagina10')
    
    {{-- Incluir página 11 --}}
    @include('contracts.pagina11')
    
    {{-- Incluir página 12 --}}
    @include('contracts.pagina12')
    
    {{-- Incluir página 13 --}}
    @include('contracts.pagina13')
    
    {{-- Incluir página 14 - PÁGINA FINAL DEL CONTRATO --}}
    @include('contracts.pagina14')
    
</body>
</html>