<x-confirmation-modal wire:model="open_modal" not_danger>
    <x-slot name="title">Comprobante detallado de pagos</x-slot>
    <x-slot name="content">¿Quieres generar el comprobante de estos pagos?</x-slot>
    <x-slot name="footer">
        <x-secondary-button color="outline" wire:click="$set('open', false)">Cancelar</x-secondary-button>
        <x-button color="gray" wire:click="$dispatch('generatePayments', {id: {{ $sale_id }}})">Generar</x-button>
    </x-slot>
</x-confirmation-modal>
