<div>
    <!--Open modal button-->
    <x-customer-button class="h-9" size="small" wire:click="$set('open', true)">Nueva dirección</x-customer-button>
    <!--Modal-->
    <x-dialog-modal wire:model="open">
        <!--Header-->
        <x-slot name="title">
            {{ $form_title }}
        </x-slot>
        <x-slot name="content">
            <!--Adress-->
            <x-inputs.group>
                <x-customer-label value="Dirección" />
                <x-input type="text" class="w-full"
                    wire:model.blur="{{ $edit_form ? 'address_edit.street' : 'address_create.street' }}" />
                <x-inputs.error for="{{ $edit_form ? 'address_edit.street' : 'address_create.street' }}" />
            </x-inputs.group>

            <!--Reference-->
            <x-inputs.group>
                <x-customer-label value="Referencia" />
                <x-input type="text" class="w-full"
                    wire:model.blur="{{ $edit_form ? 'address_edit.reference' : 'address_create.reference' }}" />
                <x-inputs.error for="{{ $edit_form ? 'address_edit.reference' : 'address_create.reference' }}" />
            </x-inputs.group>
            <!--Alias-->
            <x-inputs.group>
                <x-customer-label value="Alias" />
                <x-input type="text" class="w-full"
                    wire:model.blur="{{ $edit_form ? 'address_edit.alias' : 'address_create.alias' }}" />
                <x-inputs.error for="{{ $edit_form ? 'address_edit.alias' : 'address_create.alias' }}" />
            </x-inputs.group>
        </x-slot>
        <!--Actions buttons-->
        <x-slot name="footer">
            <div class="flex flex-row-reverse justify-between w-full">
                @if ($edit_form)
                    <!--On update-->
                    <x-customer-button size="small" wire:click="update" type="button">
                        Actualizar
                    </x-customer-button>
                @else
                    <!--On create-->
                    <x-customer-button size="small" wire:click="save">
                        Crear
                    </x-customer-button>
                @endif
                <x-secondary-button wire:click="$set('open', false)">
                    Cancelar
                </x-secondary-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
