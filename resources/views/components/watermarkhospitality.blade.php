{{-- resources/views/components/watermark.blade.php --}}
@php
    $watermarkPath = storage_path('app/public/primeh.png');
    $watermark64 = file_exists($watermarkPath) 
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($watermarkPath)) 
        : '';
@endphp

@if($watermark64)
<div class="watermark">
    <img src="{{ $watermark64 }}" alt="Watermark" class="watermark-image">
</div>
@endif