<x-form-template>
    <div class="flex flex-col gap-3">
        <!--Phone-->
        <x-inputs.group>
            <x-inputs.label value="Telefono" />
            <x-inputs.text wire:model="phone" />
            <x-inputs.error for="phone" />
        </x-inputs.group>
        <!--Email-->
        <x-inputs.group>
            <x-inputs.label value="Correo electrónico" />
            <x-inputs.text wire:model="email" />
            <x-inputs.error for="email" />
        </x-inputs.group>
        <!--Address-->
        <x-inputs.group>
            <x-inputs.label value="Dirección" />
            <x-inputs.text wire:model="new_address" />
            <x-inputs.error for="new_address" />
        </x-inputs.group>

        <h3 class="text-gray-800">Redes Sociales</h3>

        <hr>

        <!--Facebook-->
        <x-inputs.group>
            <x-inputs.label value="Facebook (link)" />
            <x-inputs.text wire:model="facebook" />
            <x-inputs.error for="facebook" />
        </x-inputs.group>
        <!--Instagram-->
        <x-inputs.group>
            <x-inputs.label value="Instagram (link)" />
            <x-inputs.text wire:model="instagram" />
            <x-inputs.error for="instagram" />
        </x-inputs.group>
        <!--Instagram-->
        <x-inputs.group>
            <x-inputs.label value="TikTok (link)" />
            <x-inputs.text wire:model="tiktok" />
            <x-inputs.error for="tiktok" />
        </x-inputs.group>

    </div>
    <x-slot name="footer">
        <x-button wire:click="update">
            Actualizar
        </x-button>
        <a href="{{ route('company-contact.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
