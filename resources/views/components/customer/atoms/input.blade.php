@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'w-full bg-transparent border-brown-primary rounded-md shadow-sm focus:border-brown-primary focus:ring-brown-primary ',
]) !!}>
