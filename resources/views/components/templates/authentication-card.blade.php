<div
    {{ $attributes->merge(['class' => ' flex flex-col sm:justify-center items-center min-h-screen pt-6 sm:pt-0 bg-gray-100 bg-white md:bg-gray-100 ']) }}>
    <header>
        <x-logo width="100" class="bg-white p-3 md:shadow-md rounded-full " />
    </header>
    <main class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white  md:overflow-hidden md:rounded-lg md:shadow-md">
        {{ $slot }}
    </main>
</div>
