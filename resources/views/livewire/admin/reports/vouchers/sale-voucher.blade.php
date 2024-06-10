<x-confirmation-modal wire:model="open">
    <x-slot name="title">Comprobante de venta</x-slot>
    <x-slot name="content">¿Quieres generar el comprobante de esta venta?</x-slot>
    <x-slot name="footer">
        <x-secondary-button color="outline" wire:click="$set('open', false)">Cancelar</x-secondary-button>
        <x-button color="gray" wire:click="$dispatch('generateSale', {id: {{ $sale_id }}})">Generar</x-button>
    </x-slot>
</x-confirmation-modal>
