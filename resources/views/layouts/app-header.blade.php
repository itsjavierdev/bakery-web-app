@props(['title', 'titleAlign' => 'left'])

<x-app>
    @push('pagetitle', "$title")
    <!--HEADER-->
    <div class="flex items-center justify-end w-full min-h-[66px] px-5 py-3  relative">
        <h1
            class="flex  w-full h-[66px] items-center font-semibold text-xl  text-gray-800 absolute top-0 left-0 z-0 {{ $titleAlign === 'center' ? 'justify-center' : 'ms-6 md:ms-0 md:justify-center' }}">
            {{ __($title) }}
        </h1>
        <div class="z-10">
            {{ $header ?? '' }}
        </div>
    </div>
    <hr class="mx-6 md:mx-0">
    <!--CONTENT-->
    <div>
        {{ $slot }}
    </div>
</x-app>
