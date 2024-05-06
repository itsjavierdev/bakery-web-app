@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'text-gray-900 -opacity-50 font-black hover:-gray-400 hover:bg-yellow-100 hover:bg-opacity-50 hover:text-gray-700 '
            : 'text-gray-600 font-thin hover:bg-yellow-100 hover:bg-opacity-50 hover:text-gray-500 focus:-gray-200 rounded-md';
@endphp

<a
    {{ $attributes->merge(['class' => "justify-start  inline-flex items-center md:text-base text-lg ps-7 pe-2 md:py-2 py-4 leading-5 transition duration-150 ease-in-out gap-2 focus:outline-none focus:bg-yellow-100 focus:rounded focus:bg-opacity-50 $classes"]) }}>
    {{ $slot }}
</a>
