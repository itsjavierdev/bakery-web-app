<x-form-template>
    <!--Name-->
    <x-inputs.group>
        <x-inputs.label value="Nombre" is_required />
        <x-inputs.text wire:model="name" />
        <x-inputs.error for="name" />
    </x-inputs.group>
    <!--Surname-->
    <x-inputs.group>
        <x-inputs.label value="Apellido" is_required />
        <x-inputs.text wire:model="surname" />
        <x-inputs.error for="surname" />
    </x-inputs.group>
    <!--Phone-->
    <x-inputs.group>
        <x-inputs.label value="Telefono" is_required />
        <x-inputs.text wire:model="phone" />
        <x-inputs.error for="phone" />
    </x-inputs.group>
    <!--Email-->
    <x-inputs.group>
        <x-inputs.label value="Correo electronico" />
        <x-inputs.text wire:model="email" />
        <x-inputs.error for="email" />
    </x-inputs.group>
    <!--Is verified-->
    <x-inputs.group>
        <x-inputs.label>
            <x-inputs.checkbox class="mr-2 mb-0.5" wire:model="verified" />
            <span>Aprobado</span>
        </x-inputs.label>
        <x-inputs.error for="verified" />
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="save" wire:loading.attr="disabled">
            Crear
        </x-button>
        <a href="{{ route('customers.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
