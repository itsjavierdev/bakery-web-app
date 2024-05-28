@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'bg-transparent border-2 border-brown-primary w-16 text-brown-primary focus:border-brown-primary focus:ring-white pl-3 rounded-md',
]) !!} type="number" id="miInput">
