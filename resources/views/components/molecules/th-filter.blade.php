@props(['key', 'sort_by', 'sort_direction'])

<x-th wire:click="sort('{{ $key }}')">
    <h3>{{ $slot }}</h3>
    @if ($sort_by === $key)
        @if ($sort_direction == 'asc')
            <i class="icon-asc float-right text-xl mt-1"></i>
        @else
            <i class="icon-sort-desc float-right text-xl mt-1"></i>
        @endif
    @else
        <i class="icon-sort float-right text-xl mt-1"></i>
    @endif

</x-th>
