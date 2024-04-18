<x-admin-header title="Pedidos">
    <x-slot name="header">
        <a href="{{ route('pedidos.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.orders.read />
    </div>
    <livewire:admin.orders.delete />
</x-admin-header>
