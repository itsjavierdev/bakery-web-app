<x-confirmation-modal wire:model="open" not_danger>
    <x-slot name="title">Comprobante de pago</x-slot>
    <x-slot name="content">¿Quieres generar el comprobante de este pago?</x-slot>
    <x-slot name="footer">
        <x-secondary-button color="outline" wire:click="$set('open', false)">Cancelar</x-secondary-button>
        <x-button color="gray" wire:click="$dispatch('generatePayment', {id: {{ $payment_id }}})">Generar</x-button>
    </x-slot>
</x-confirmation-modal>
