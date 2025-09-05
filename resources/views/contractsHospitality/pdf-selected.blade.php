<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contract Document</title>
    @include('contracts.styles')
    <style>
      .page-break { page-break-after: always; }
      @media print {
        .page-break { display: block; }
      }
    </style>
</head>
<body>
@php
  // Rutas e imágenes
  $logoPath = storage_path('app/public/Prime.png');
  $bldgPath = storage_path('app/public/Edificio.png');

  $logo64 = file_exists($logoPath)
      ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
      : '';
  $bldg64 = file_exists($bldgPath)
      ? 'data:image/png;base64,' . base64_encode(file_get_contents($bldgPath))
      : '';
@endphp

{{-- PÁGINA 0 --}}
@include('contractsHospitality.pagina0', ['logo64' => $logo64, 'bldg64' => $bldg64])
<div class="page-break"></div>

{{-- PÁGINA 00 --}}
@include('contractsHospitality.pagina00', ['logo64' => $logo64, 'bldg64' => $bldg64])
<div class="page-break"></div>

{{-- PÁGINA 1 --}}
@include('contractsHospitality.pagina1', ['pageNumber' => 1])
<div class="page-break"></div>

{{-- PÁGINA 2 --}}
@include('contractsHospitality.pagina2', ['pageNumber' => 2])
<div class="page-break"></div>

{{-- PÁGINA 3 --}}
@include('contractsHospitality.pagina3', ['pageNumber' => 3])
<div class="page-break"></div>

{{-- PÁGINA 4 --}}
@include('contractsHospitality.pagina4', ['pageNumber' => 4])
<div class="page-break"></div>

{{-- PÁGINA 5 --}}
@include('contractsHospitality.pagina5', ['pageNumber' => 5])
<div class="page-break"></div>

{{-- PÁGINA 6 --}}
@include('contractsHospitality.pagina6', ['pageNumber' => 6])
<div class="page-break"></div>

{{-- PÁGINA 7 --}}
@include('contractsHospitality.pagina7', ['pageNumber' => 7])
<div class="page-break"></div>

{{-- PÁGINA 8 --}}
@include('contractsHospitality.pagina8', ['pageNumber' => 8])
<div class="page-break"></div>

{{-- PÁGINA 9 --}}
@include('contractsHospitality.pagina9', ['pageNumber' => 9])
<div class="page-break"></div>

{{-- PÁGINA 10 --}}
@include('contractsHospitality.pagina10', ['pageNumber' => 10])
<div class="page-break"></div>

{{-- PÁGINA 11 
@include('contractsHospitality.pagina11', ['pageNumber' => 11])
<div class="page-break"></div>


@include('contractsHospitality.pagina12', ['pageNumber' => 12])
<div class="page-break"></div>


@include('contractsHospitality.pagina13', ['pageNumber' => 13])
<div class="page-break"></div>


@include('contractsHospitality.pagina14', ['pageNumber' => 14])
<div class="page-break"></div>


@include('contractsHospitality.pagina15', ['pageNumber' => 15])
<div class="page-break"></div>


@include('contractsHospitality.pagina16', ['pageNumber' => 16])
<div class="page-break"></div>


@include('contractsHospitality.pagina17', ['pageNumber' => 17])
<div class="page-break"></div>


@include('contractsHospitality.pagina18', ['pageNumber' => 18])
<div class="page-break"></div>

@include('contractsHospitality.pagina19', ['pageNumber' => 19])
<div class="page-break"></div>


@include('contractsHospitality.pagina20', ['pageNumber' => 20])
<div class="page-break"></div>


@include('contractsHospitality.pagina21', ['pageNumber' => 21])
<div class="page-break"></div>


@include('contractsHospitality.pagina22', ['pageNumber' => 22])
<div class="page-break"></div>


@include('contractsHospitality.pagina23', ['pageNumber' => 23])
<div class="page-break"></div>


@include('contractsHospitality.pagina24', ['pageNumber' => 24])
<div class="page-break"></div>


@include('contractsHospitality.pagina25', ['pageNumber' => 25])
<div class="page-break"></div>


@include('contractsHospitality.pagina26', ['pageNumber' => 26])
--}}
</body>
</html>
