@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'bg-yellow-500 text-gray-50 font-bold rounded-lg hover:bg-yellow-400 hover:text-white focus:ring-yellow-500 focus:ring-2 focus:ring-offset-2'
            : 'text-gray-600 hover:text-gray-500 focus:bg-yellow-100';
@endphp

<a
    {{ $attributes->merge(['class' => "md:justify-start justify-center inline-flex items-center md:text-lg text-xl px-3 py-2 leading-5 transition duration-150 ease-in-out gap-2 focus:outline-none $classes"]) }}>
    {{ $slot }}
</a>
