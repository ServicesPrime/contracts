<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contract Document</title>
    @include('contracts.styles')
    <style>.page-break { page-break-after: always; }</style>
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

  // Asegura array
  $pages = isset($pages) && is_array($pages) ? $pages : [];
@endphp

@foreach(($pages ?? []) as $p)
  @php
    $p = (string) $p;
    $candidates = [
      "contracts.pagina{$p}",
      "contracts.pagina" . str_pad($p, 2, '0', STR_PAD_LEFT),
    ];
    $viewToInclude = null;
    foreach ($candidates as $cand) {
      if (view()->exists($cand)) { $viewToInclude = $cand; break; }
    }
  @endphp

  @if($viewToInclude)
    @include($viewToInclude, [
      'logo64'   => $logo64,
      'bldg64'   => $bldg64,
      'contract' => $contract
    ])

    {{-- 👇 solo agrega salto si NO es la última página --}}
    @unless($loop->last)
      <div class="page-break"></div>
    @endunless
  @endif
@endforeach


</body>
</html>
