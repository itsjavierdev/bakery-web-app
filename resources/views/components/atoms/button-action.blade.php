@props(['color' => 'sky'])

@php
    switch ($color) {
        case 'sky':
            $color_classes = 'text-sky-700 focus:ring-sky-700';
            break;
        case 'green':
            $color_classes = 'text-green-700 focus:ring-green-700';
            break;
        case 'orange':
            $color_classes = 'text-orange-500 focus:ring-orange-500';
            break;
        case 'red':
            $color_classes = 'text-red-700 focus:ring-red-700';
            break;

        default:
            $color_classes = 'text-sky-700 focus:ring-sky-700';
            break;
    }
@endphp <button
    {{ $attributes->merge(['class' => "bg-transparent w-full justify-center  border-gray-300 border-e-medium focus:ring-2  focus:ring-inset flex items-center first:rounded-bl-md last:rounded-br-md last:border-e-0 md:w-10 md:h-10 p-2 md:border-0 md:!rounded-full transition ease-in-out duration-150 active focus:outline-none hover:bg-gray-200 md:hover:bg-gray-100 $color_classes"]) }}>
    {{ $slot }}
</button>
