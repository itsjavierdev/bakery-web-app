@props(['color' => 'gray', 'text_size' => 'text-xs']) @php
    switch ($color) {
        case 'gray':
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;

        case 'yellow':
            $color_classes =
                'bg-yellow-500 text-white hover:bg-yellow-400 focus:bg-yellow-400 active:bg-yellow-600 focus:ring-yellow-400 ';
            break;

        case 'red':
            $color_classes =
                'bg-red-600 text-white border-transparent hover:bg-red-500 active:bg-red-700 focus:ring-red-500';
            break;

        case 'blue':
            $color_classes =
                'bg-blue-600 text-white border-transparent hover:bg-blue-500 active:bg-blue-700 focus:ring-blue-500';
            break;

        default:
            $color_classes =
                'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ';
            break;
    }
@endphp <button
    {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center px-2 py-2 border rounded-md font-semibold justify-center uppercase tracking-widest gap-1 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 $text_size $color_classes"]) }}>
    {{ $slot }}
</button>
