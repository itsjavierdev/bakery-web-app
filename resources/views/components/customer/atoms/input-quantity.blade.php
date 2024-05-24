@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'bg-transparent border-2 border-brown-primary w-16 text-brwon-primary focus:border-border focus:ring-white pl-3',
]) !!} type="number" id="miInput">
