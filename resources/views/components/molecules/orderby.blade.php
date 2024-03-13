@props(['columns'])
<!--Order by mobile screens-->
<div {{ $attributes->merge(['class' => 'md:hidden flex']) }}>
    <!--Sort attribute-->
    <x-inputs.select wire:model.change="sort_by" class="w-3/5 rounded-e-none border-r-0">
        @foreach ($columns as $index => $column)
            <option value="{{ $column->key }}">
                @if ($index === 0)
                    Ordenar por:
                @endif
                {{ $column->label }}
            </option>
        @endforeach
    </x-inputs.select>
    <!--Sort direction-->
    <x-inputs.select wire:model.change="sort_direction" class="w-2/5 rounded-s-none border-l">
        <option value="desc">Z-A</option>
        <option value="asc">A-Z</option>
    </x-inputs.select>
</div>
