@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} type="file"
    {{ $attributes->merge(['class' => 'w-full bg-transparent border p-1.5 border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 file:border-none file:rounded-sm file:mr-2 file:text-gray-800']) }}>
