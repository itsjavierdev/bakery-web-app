<textarea {!! $attributes->merge([
    'class' =>
        'w-full bg-transparent border-brown-primary rounded-md shadow-sm focus:border-brown-primary focus:ring-brown-primary placeholder-brown-primary placeholder-opacity-70',
]) !!}>{{ $slot }}</textarea>
