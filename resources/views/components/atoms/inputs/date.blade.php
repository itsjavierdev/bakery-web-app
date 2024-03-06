@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'rounded-md border-gray-300 shadow-sm bg-transparentfocus:border-indigo-500 focus:ring-indigo-500 ',
]) !!} type="date">
