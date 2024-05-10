<x-form-template>
    <!--Name-->
    <x-inputs.group>
        <x-inputs.label value="Nombre" />
        <x-inputs.text wire:model="name" />
        <x-inputs.error for="name" />
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="save" wire:loading.attr="disabled">
            Crear
        </x-button>
        <a href="{{ route('categories.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
