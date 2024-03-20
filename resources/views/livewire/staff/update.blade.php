<x-form-template>
    <div class="mb-4 max-w-2xl">
        <x-inputs.label value="Nombre" />
        <x-inputs.text class="w-full mt-2" wire:model="name" />
        <x-inputs.error for="name" />
    </div>
    <div class="mb-4 max-w-2xl">
        <x-inputs.label value="Apellido" />
        <x-inputs.text class="w-full mt-2" wire:model="surname" />
        <x-inputs.error for="surname" />
    </div>
    <div class="mb-4 max-w-2xl">
        <x-inputs.label value="Telefono" />
        <x-inputs.text type="tel" class="w-full mt-2" wire:model="phone" />
        <x-inputs.error for="phone" />
    </div>
    <div class="mb-4 max-w-2xl">
        <div class="flex flex-row gap-4">
            <div class="w-full">
                <x-inputs.label value="Carnet de identidad" />
                <x-inputs.text class="w-full mt-2" wire:model="CI_number" />
                <x-inputs.error for="CI_number" />
            </div>
            <div class="w-full">
                <x-inputs.label value="Extensión" />
                <x-atoms.inputs.select class="w-full mt-2" wire:model.blur="CI_extension">
                    <option value="">Seleccionar</option>
                    <option value="SC">SC</option>
                    <option value="LP">LP</option>
                    <option value="CB">CB</option>
                    <option value="PO">PO</option>
                    <option value="OR">OR</option>
                    <option value="CH">CH</option>
                    <option value="TJ">TJ</option>
                    <option value="BE">BE</option>
                    <option value="PA">PA</option>
                </x-atoms.inputs.select>
                <x-atoms.inputs.error for="CI_extension" />
            </div>
        </div>
        <x-inputs.error for="CI" />
    </div>
    <div class="mb-4 max-w-2xl">
        <x-inputs.label value="Fecha de nacimiento" />
        <x-inputs.date class="w-full mt-2" wire:model="birthdate" />
        <x-inputs.error for="birthdate" />
    </div>
    <x-slot name="footer">
        <x-button wire:click="update">
            Actualizar
        </x-button>
        <a href="{{ route('personal.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
