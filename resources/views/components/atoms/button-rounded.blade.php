<button
    {{ $attributes->merge(['class' => 'bg-transparent justify-center w-10 h-10 p-2 !rounded-full transition ease-in-out duration-150 active focus:outline-none hover:bg-gray-100']) }}>
    {{ $slot }}
</button>
