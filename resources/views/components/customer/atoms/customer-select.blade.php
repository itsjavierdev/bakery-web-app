<select {!! $attributes->merge([
    'class' =>
        'md:w-auto w-full bg-transparent border-2 border-brown-primary text-brown-primary rounded focus:border-border focus:ring-white ',
]) !!}>
    {{ $slot }}
</select>
