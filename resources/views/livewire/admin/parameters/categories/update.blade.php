<x-form-template>
    <!--Name-->
    <x-inputs.group>
        <x-inputs.label value="Nombre" is_required />
        <x-inputs.text wire:model="name" />
        <x-inputs.error for="name" />
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="update" wire:loading.attr="disabled">
            Actualizar
        </x-button>
        <a href="{{ route('categories.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
