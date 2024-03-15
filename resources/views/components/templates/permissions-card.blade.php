<div class="w-full px-2 flex flex-col sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5">
    <div class="w-full h-full mb-4 bg-white rounded-lg border-medium border-gray-300 overflow-hidden">
        <header>
            <x-inputs.label
                class="font-semibold px-4 py-2 !text-base bg-gray-100 border-b-medium border-gray-300 text-neutral-500 opacity-90 flex items-center w-full cursor-pointer">
                {{ $header ?? '' }}
            </x-inputs.label>
        </header>
        <ul class="flex-grow p-4">
            {{ $slot }}
        </ul>
    </div>
</div>
