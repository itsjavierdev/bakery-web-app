<x-form-template>
    <livewire:admin.reports.vouchers.payment-voucher />
    <x-inputs.group>
        <x-inputs.disabled title="Cliente">
            <p>{{ $payment->customer->name . ' ' . $payment->customer->surname }}</p>
        </x-inputs.disabled>
    </x-inputs.group>

    <x-inputs.group>
        <x-inputs.disabled title="Recibido por">
            <p>{{ $payment->staff->name . ' ' . $payment->staff->surname }}</p>
        </x-inputs.disabled>
    </x-inputs.group>

    <x-inputs.group>
        <x-inputs.disabled title="Monto pagado">
            <p>Bs{{ $payment->amount }}</p>
        </x-inputs.disabled>
    </x-inputs.group>

    <x-inputs.group>
        <div class="flex gap-5">
            <div class="w-full">
                <x-inputs.disabled title="Venta asociada">
                    <p>Venta #{{ $sale->id }}</p>
                </x-inputs.disabled>
            </div>
            <div class="w-full">

                <x-inputs.disabled title="Total de la venta">
                    <p>Bs{{ $sale->total }}</p>
                </x-inputs.disabled>
            </div>
        </div>
    </x-inputs.group>

    <x-inputs.group>
        <x-inputs.disabled title="Saldo anterior">
            <p>Bs{{ $previous_balance }}</p>
        </x-inputs.disabled>
    </x-inputs.group>

    <x-inputs.group>
        <x-inputs.disabled title="Saldo">
            <p>Bs{{ $sale->total - $sale->paid_amount }}</p>
        </x-inputs.disabled>
    </x-inputs.group>

    <x-slot name="footer">
        <x-button wire:loading.attr="disabled" wire:click="$dispatch('generatePayment', {id: {{ $payment->id }}})">
            Generar comprobante
        </x-button>
        <a href="{{ route('debts.all') }}">
            <x-secondary-button>
                Volver a deudas
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
