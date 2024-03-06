@props(['color' => 'gray', 'text_size' => 'text-xs']) @php
    switch ($color) {
        case 'gray':
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;

        case 'orange':
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;

        case 'red':
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;

        case 'blue':
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;

        case 'sky':
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;

        case 'green':
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;

        case 'outline':
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;

        default:
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;
    }
@endphp <button
    {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-2 py-2 border border-transparent rounded-md font-semibold uppercase tracking-widest gap-1 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 $text_size $color_classes"]) }}>
    {{ $slot }}
</button>
