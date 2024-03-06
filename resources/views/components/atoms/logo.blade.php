@props(['width' => 50])

<img width="{{ $width }}" src="{{ asset('/logo/favicon.png') }}" alt="Logo de la aplicación"
    {{ $attributes->merge(['class' => '']) }}>
