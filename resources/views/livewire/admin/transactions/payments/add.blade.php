<x-form-template>
    <!--Info-->
    <x-inputs.group>
        <div class="flex flex-row gap-3 w-full">
            <x-inputs.disabled title="Total de la venta" class="w-full">
                <p>{{ $sale->total }}</p>
            </x-inputs.disabled>
            <x-inputs.disabled title="Saldo" class="w-full">
                <p>{{ $remaining_amount }}</p>
            </x-inputs.disabled>
        </div>
    </x-inputs.group>
    <!--Paid amount-->
    <x-inputs.group>
        <x-inputs.label value="Monto a abonar" />
        <x-inputs.text type="number" wire:model.change="paid_amount" :disabled="$paid_remaining ? true : false" />
        <x-inputs.error for="paid_amount" />
        <x-inputs.label class="mt-2">
            <x-inputs.checkbox class="mr-2 mb-0.5" wire:model.change="paid_remaining" />
            <span>Pagar saldo</span>
        </x-inputs.label>
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="add" wire:loading.attr="disabled">
            Agregar
        </x-button>
        <a href="{{ route('payments.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
