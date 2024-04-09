<x-form-template>
    <!--Name-->
    <x-inputs.group>
        <x-inputs.label value="Nombre" />
        <x-inputs.text wire:model="name" />
        <x-inputs.error for="name" />
    </x-inputs.group>
    <!--Category-->
    <x-inputs.group>
        <x-inputs.label value="Categoria" />
        <x-inputs.select wire:model="category_id">
            <option value="">Seleccionar</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-inputs.select>
        <x-inputs.error for="category_id" />

    </x-inputs.group>
    <!--Price-->
    <x-inputs.group>
        <x-inputs.label value="Precio" />
        <x-inputs.text wire:model="price" />
        <x-inputs.error for="price" />
    </x-inputs.group>
    <!--Bag quantity-->
    <x-inputs.group>
        <x-inputs.label value="Cantidad por bolsa" />
        <x-inputs.text type="number" wire:model="bag_quantity" />
        <x-inputs.error for="bag_quantity" />
    </x-inputs.group>
    <!--Description-->
    <x-inputs.group>
        <x-inputs.label value="Descripción" />
        <x-inputs.text wire:model="description" />
        <x-inputs.error for="description" />
    </x-inputs.group>
    <x-inputs.group>
        <x-inputs.label value="Imagenes" />
        <x-inputs.file wire:model="images" accept="image/*" multiple />
        <x-inputs.error for="images.*" />
        <x-inputs.error for="images" />
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="save">
            Crear
        </x-button>
        <a href="{{ route('productos.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
