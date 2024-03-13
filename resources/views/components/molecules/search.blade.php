<div {{ $attributes->merge(['class' => 'flex flex-row-reverse md:flex-row items-center md:w-1/2']) }}>
    <x-inputs.select wire:model.change="search_column"
        class="w-2/5 md:w-2/6 rounded-l-none border-l-0 md:rounded-r-none md:border-r-0 md:rounded-l-md md:border-l">
        <option value="">Todo</option>
        @foreach ($this->columns() as $column)
            <option value="{{ $column->key }}">{{ $column->label }}</option>
        @endforeach
    </x-inputs.select>
    <x-inputs.text wire:model.change="search"
        class="w-3/5 md:w-4/6 rounded-r-none border-r md:rounded-l-none md:border-l md:rounded-r-md md:border-r"
        placeholder="Buscar" />
</div>
