<x-confirmation-modal wire:model="open">
    <x-slot name="title">Eliminar registro</x-slot>
    <x-slot name="content">¿Estás seguro de eliminar este registro?</x-slot>
    <x-slot name="footer">
        <x-secondary-button color="outline" wire:click="$set('open', false)">Cancelar</x-secondary-button>
        <x-button color="red" wire:click="$dispatch('delete', {id: {{ $delete_id }}})">Eliminar</x-button>
    </x-slot>
</x-confirmation-modal>
