@props(['active'])

<h3 class="p-4 cursor-pointer {{ $active ? ' text-brown-primary font-bold' : '' }} hover:text-brown-primary ">
    @if ($active)
        <span class="w-4 h-4 bg-brown-primary rounded-full mr-2 px-1"></span>
    @endif
    {{ $slot }}
</h3>
