<x-form-template>
    <!--Title-->
    <x-inputs.group>
        <x-inputs.label value="Titulo" />
        <x-inputs.text wire:model.change="title" />
        <x-inputs.error for="title" />
    </x-inputs.group>
    <!--Product-->
    <x-inputs.group>
        <x-inputs.label value="Asociar producto" />
        <div class="flex gap-2">
            <div class=" flex gap-3 w-full items-center bg-gray-100 py-2.5 px-4 rounded-md">
                <p>{{ $product ? $product->name : '' }}</p>
            </div>
            <x-secondary-button wire:click="$set('open', true)" tabindex="-1"><i
                    class="icon-bars text-2xl"></i></x-secondary-button>
        </div>
        <x-inputs.error for="product.id" />
    </x-inputs.group>
    <!--Image-->
    <x-inputs.group>
        <x-inputs.label value="Imagen" />
        <x-inputs.file wire:model="image" />
        <x-inputs.error for="image" />
        @if ($image)
            <div class="mt-3 relative {{ $put_filter ? 'content-banner' : '' }}">
                <img src="{{ $image->temporaryUrl() }}" class="w-full aspect-video object-cover rounded " />
                @if ($title)
                    <p class="text-4xl text-white italic absolute w-full h-full flex items-center justify-center z-50 top-0 left-0 [text-shadow:_0_4px_0_rgb(0_0_0_/_50%)]"
                        style="font-family: 'Caveat', cursive;">
                        {{ $title }}
                    </p>
                @endif
            </div>
        @endif

    </x-inputs.group>
    <x-inputs.label class="mt-2">
        <x-inputs.checkbox class="mr-2 mb-0.5" wire:model.change="put_filter" />
        <span>Aplicar filtro</span>
    </x-inputs.label>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="save">
            Crear
        </x-button>
        <a href="{{ route('featured.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
    <!--Add product-->
    <x-dialog-modal wire:model=open>
        <x-slot name="title">
            <h2 class="text-lg font-semibold">Seleccionar producto</h2>
        </x-slot>
        <x-slot name=content>
            <livewire:admin.parameters.products.read add />
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end w-full">
                <x-secondary-button wire:click="$set('open', false)">Cancelar</x-secondary-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</x-form-template>

@push('links')
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Montserrat&family=Varela+Round&display=swap"
        rel="stylesheet">
@endpush
