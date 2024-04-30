<div class="w-full px-2 flex flex-col sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4">
    <div {{ $attributes->merge(['class' => 'flex text-white rounded-md w-full mb-4']) }}>
        <div class="p-4 flex gap-1 items-center bg-black bg-opacity-10 text-4xl text-white relative">
            {{ $icon ?? '' }}
        </div>
        <div class="p-3 w-full">
            <h4>{{ $title }}</h4>
            <span class="font-bold text-xl">{{ $slot }}</span>
        </div>
    </div>
</div>
