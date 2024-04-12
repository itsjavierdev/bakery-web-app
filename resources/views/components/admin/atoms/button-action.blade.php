<button
    {{ $attributes->merge(['class' => 'bg-transparent w-full justify-center  border-gray-300 border-e-medium flex items-center first:rounded-bl-md last:rounded-br-md last:border-e-0 md:w-10 md:h-10 p-2 md:border-0 md:!rounded-full transition ease-in-out duration-150 focus:outline-none hover:bg-gray-200 md:hover:bg-gray-100 ']) }}>
    {{ $slot }}
</button>
