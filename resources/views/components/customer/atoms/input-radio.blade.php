@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'bg-black accent-brown-primary checked:bg-brown-primary focus:bg-brown-primary active:bg-transparent checked:ring-0 text-brown-primary active:ring-0 focus:border-transparent active:border-transparent transition-all duration-200',
]) !!} type="radio">
