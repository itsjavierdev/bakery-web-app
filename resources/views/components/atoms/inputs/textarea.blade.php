<textarea {!! $attributes->merge([
    'class' =>
        'w-full bg-transparent border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 ',
]) !!}>{{ $slot }}</textarea>
