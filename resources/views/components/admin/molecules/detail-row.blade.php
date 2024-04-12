@props(['isResponsive' => false, 'title', 'classContent' => ''])

@php
    if ($isResponsive) {
        $titleClasses = 'col-span-3 md:col-span-1';
        $contentClasses = 'md:col-span-2 col-span-3';
    } else {
        $titleClasses = '';
        $contentClasses = 'col-span-2';
    }
@endphp

<div {{ $attributes->merge(['class' => 'p-4 grid grid-cols-3 odd:bg-gray-50 even:bg-white']) }}>
    <h3 class="text-gray-500 font-bold {{ $titleClasses }}">{{ $title }}</h3>
    <div class="{{ $contentClasses }} {{ $classContent }}">{{ $slot }} </div>
</div>
