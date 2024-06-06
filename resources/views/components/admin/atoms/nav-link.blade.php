@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'bg-yellow-500 text-gray-50 font-bold rounded-lg hover:bg-yellow-400 hover:text-white focus:ring-yellow-500 focus:ring-2 focus:ring-offset-2 '
            : 'text-gray-600 hover:bg-yellow-100 bg-opacity-50 focus:bg-yellow-100 focus:rounded-md focus:bg-opacity-50';
@endphp

<a
    {{ $attributes->merge(['class' => "justify-start inline-flex items-center text-xl md:text-lg md:py-2 px-2 py-4 mx-1 leading-5 transition duration-150 ease-in-out gap-2 focus:outline-none $classes"]) }}>
    {{ $slot }}
</a>
