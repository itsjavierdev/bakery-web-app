<x-form-template>
    <!--Name-->
    <x-inputs.group>
        <x-inputs.label value="Nombre" />
        <x-inputs.text wire:model="name" />
        <x-inputs.error for="name" />
    </x-inputs.group>
    <!--Surname-->
    <x-inputs.group>
        <x-inputs.label value="Apellido" />
        <x-inputs.text wire:model="surname" />
        <x-inputs.error for="surname" />
    </x-inputs.group>
    <!--Phone-->
    <x-inputs.group>
        <x-inputs.label value="Telefono" />
        <x-inputs.text wire:model="phone" />
        <x-inputs.error for="phone" />
    </x-inputs.group>
    <!--Email-->
    <x-inputs.group>
        <x-inputs.label value="Correo electronico" />
        <x-inputs.text wire:model="email" />
        <x-inputs.error for="email" />
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="update" wire:loading.attr="disabled">
            Actualizar
        </x-button>
        <a href="{{ route('customers.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
