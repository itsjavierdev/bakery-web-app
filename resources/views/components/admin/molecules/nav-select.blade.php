@props(['active' => false])

@php
    $activeClasses =
        'bg-yellow-500 text-gray-50 font-bold rounded-lg hover:bg-yellow-500 hover:bg-opacity-90 hover:text-white focus:ring-yellow-500 focus:ring-2 focus:ring-offset-2';
    $inactiveClasses = 'text-gray-600 hover:bg-yellow-100 focus:bg-yellow-100 focus:bg-opacity-50 hover:bg-opacity-50';
@endphp

<div class="w-full" x-data="{ open: @json($active) }" x-cloak>
    <button @click="open = ! open"
        {{ $attributes->merge(['class' => 'w-full flex md:justify-between justify-between inline-flex items-center md:text-base text-xl px-2 py-4 md:py-2 leading-5 transition duration-150 ease-in-out gap-2 focus:outline-none cursor-pointer', ':class' => 'open ? \'' . $activeClasses . '\' : \'' . $inactiveClasses . '\'']) }}>
        <div class="flex items-center gap-1">

            {{ $slot }}
        </div>

        <i class="icon-chevron-up text-sm" x-show="open"></i>
        <i class="icon-chevron-down text-sm" x-show="!open"></i>
    </button>
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" style="display: none;"
        class="w-full flex flex-col my-1 p-1">
        {{ $content ?? '' }}
    </div>
</div>
