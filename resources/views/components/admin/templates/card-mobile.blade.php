<div class='bg-white border-medium border-gray-300 rounded-lg overflow-hidden'>
    @if ($header ?? false)
        <header
            class="flex justify-between border-b-medium font-medium border-gray-300 bg-gray-100 text-neutral-500 text-bold py-2.5 px-3.5">
            {{ $header ?? '' }}
        </header>
    @endif

    <div class="rounded overflow-hidden *:flex *:justify-between *:p-2.5 odd:*:bg-white even:*:bg-gray-50">
        {{ $slot }}
    </div>
    @if ($footer ?? false)
        <footer class="flex bg-gray-100 w-full border-t-medium border-gray-300">
            {{ $footer ?? '' }}

        </footer>
    @endif
</div>
