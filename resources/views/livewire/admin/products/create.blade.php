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
        <x-inputs.label value="Precio por bolsa" />
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
        <x-inputs.textarea wire:model="description"></x-inputs.textarea>
        <x-inputs.error for="description" />
    </x-inputs.group>
    <x-inputs.group>
        <x-inputs.label value="Imagenes" />
        <x-inputs.file wire:model="images" accept="image/*" multiple />
        <x-inputs.error for="images.*" />
        <x-inputs.error for="temporary_images" />
        <ul wire:sortable="updateImagesOrder" class="flex gap-5 flex-wrap  mt-5">
            @foreach ($sorted_images as $image)
                <li wire:sortable.item="{{ $image['temp_id'] }}" wire:key="image-{{ $image['temp_id'] }}"
                    class="relative">
                    <div wire:sortable.handle>
                        <img src="{{ $image['path']->temporaryUrl() }}" class="w-28 h-28 object-cover rounded " />
                    </div>
                    <button wire:click.stop="deleteImage('{{ $image['temp_id'] }}')"
                        class="absolute -right-2 -top-2 bg-gray-200 rounded-full w-6 h-6 flex justify-center items-center border-medium border-gray-300">
                        <i class="icon-x text-gray-500"></i>
                    </button>
                </li>
            @endforeach
        </ul>
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

@push('js')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
@endpush
