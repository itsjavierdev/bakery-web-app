<x-form-template>
    <x-inputs.group>
        <x-inputs.label value="Nombre" />
        <x-inputs.text class="w-full mt-2" wire:model="name" />
        <x-inputs.error for="name" />
    </x-inputs.group>
    <x-slot name="footer">
        <x-button wire:click="save">
            Crear
        </x-button>
        <a href="{{ route('categorias.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
