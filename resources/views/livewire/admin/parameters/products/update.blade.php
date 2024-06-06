<x-form-template>
    <!--Nombre-->
    <x-inputs.group>
        <x-inputs.label value="Nombre" is_required />
        <x-inputs.text wire:model="name" />
        <x-inputs.error for="name" />
    </x-inputs.group>
    <!--Category-->
    <x-inputs.group>
        <x-inputs.label value="Categorías" is_required />
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
        <x-inputs.label value="Precio" is_required />
        <x-inputs.text wire:model="price" />
        <x-inputs.error for="price" />
    </x-inputs.group>
    <!--Bag quantity-->
    <x-inputs.group>
        <x-inputs.label value="Cantidad por bolsa" is_required />
        <x-inputs.text type="number" wire:model="bag_quantity" />
        <x-inputs.error for="bag_quantity" />
    </x-inputs.group>
    <!--Description-->
    <x-inputs.group>
        <x-inputs.label value="Descripción" />
        <x-inputs.textarea wire:model="description"></x-inputs.textarea>
        <x-inputs.error for="description" />
    </x-inputs.group>
    <!--Images-->
    <x-inputs.group>
        <x-inputs.label value="Imagenes" is_required />
        <!--Input images-->
        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <x-inputs.file wire:model="new_images" accept="image/*" multiple />

            <div class="pt-2 w-full rounded-sm overflow-hidden" x-show="uploading">
                <progress max="100" class="!w-full" x-bind:value="progress"></progress>
            </div>
        </div>
        <x-inputs.error for="new_images.*" />
        <x-inputs.error for="images" />
        <ul wire:sortable="updateImagesOrder" class="flex gap-5 flex-wrap  mt-5">
            @foreach ($sorted_images as $image)
                @if (is_object($image['path']))
                    <!--New images-->
                    <li wire:sortable.item="{{ $image['temp_id'] }}" wire:key="image-{{ $image['temp_id'] }}"
                        class="relative">
                        <div wire:sortable.handle>
                            <img src="{{ $image['path']->temporaryUrl() }}" class="w-28 h-28 object-cover rounded ">
                        </div>
                        <button wire:click="deleteImage('{{ $image['temp_id'] }}')"
                            class="absolute -right-1 -top-1 bg-gray-200 rounded-full w-6 h-6 flex justify-center items-center border-medium border-gray-300">
                            <i class="icon-x text-gray-500"></i>
                        </button>
                    </li>
                @else
                    <!--Old images-->
                    <li wire:sortable.item="{{ $image['id'] }}" wire:key="image-{{ $image['id'] }}" class="relative">
                        <div wire:sortable.handle>
                            <img src="{{ asset('storage/products/128/' . $image['path']) }}"
                                class="w-28 h-28 object-cover rounded ">
                        </div>
                        <button wire:click="deleteImage('{{ $image['id'] }}')"
                            class="absolute -right-1 -top-1 bg-gray-200 rounded-full w-6 h-6 flex justify-center items-center border-medium border-gray-300">
                            <i class="icon-x text-gray-500"></i>
                        </button>
                    </li>
                @endif
            @endforeach
        </ul>
    </x-inputs.group>
    <!--Discontinued-->
    <x-inputs.group>
        <x-inputs.label>
            <x-inputs.checkbox class="mr-2 mb-0.5" wire:model="discontinued" />
            <span>Descatalogado</span>
        </x-inputs.label>
        <x-inputs.error for="discontinued" />
    </x-inputs.group>
    <x-slot name="footer">
        <x-button wire:loading.attr="disabled" wire:target="update, new_images" wire:click="update">
            Actualizar
        </x-button>
        <a href="{{ route('products.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>

@push('js')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
@endpush
