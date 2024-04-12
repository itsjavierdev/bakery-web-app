<select {{ $attributes->merge(['class' => 'w-full bg-transparent border-gray-300 rounded-md shadow-sm ']) }}>
    {{ $slot }}
</select>
