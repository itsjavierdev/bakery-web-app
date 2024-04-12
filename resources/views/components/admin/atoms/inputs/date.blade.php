@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'w-full rounded-md border-gray-300 shadow-sm bg-transparentfocus:border-indigo-500 focus:ring-indigo-500 ',
]) !!} type="date">
