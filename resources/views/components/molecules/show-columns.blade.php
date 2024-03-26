<x-dropdown width="w-48" align="left" class="w-full md:w-auto">
    <x-slot name="trigger">
        <div
            class="!w-full bg-transparent border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 flex gap-2 items-center justify-between">
            <p>
                Columnas
            </p>
            <i class="icon-chevron-down text-gray-600 text-sm"></i>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col gap-2 p-3">
            @foreach ($this->columns() as $column)
                <label>
                    <x-inputs.checkbox wire:model.blur="selected_columns" value="{{ $column->key }}" />
                    {{ $column->label }}
                </label>
            @endforeach
        </div>
    </x-slot>
</x-dropdown>
