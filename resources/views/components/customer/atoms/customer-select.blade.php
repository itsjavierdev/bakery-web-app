@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'md:w-auto w-full bg-transparent border border-brown-primary text-brown-primary rounded focus:border-brown-primary focus:ring-brown-primary placeholder-brown-primary',
]) !!}>
    {{ $slot }}
</select>
