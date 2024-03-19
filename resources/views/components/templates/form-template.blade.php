<div class="h-full flex-grow flex flex-col justify-between ">
    <div class="px-6 pt-6 pb-4">
        {{ $slot }}
    </div>
    <div class="flex flex-row-reverse justify-between md:justify-end  gap-5  w-full bg-gray-100 p-5">
        {{ $footer ?? '' }}
    </div>
</div>
