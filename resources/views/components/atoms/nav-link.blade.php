@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'bg-yellow-500 text-gray-50 font-bold rounded-lg hover:bg-yellow-400 hover:text-white'
            : 'text-gray-600 hover:text-gray-500';
@endphp

<a
    {{ $attributes->merge(['class' => "md:justify-start justify-center inline-flex items-center md:text-lg text-xl px-3 py-2 leading-5 transition duration-150 ease-in-out gap-2 $classes"]) }}>
    {{ $slot }}
</a>
