<x-admin-header title="Pedidos">
    <x-slot name="header">
        <a href="{{ route('orders.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.transactions.orders.read />
    </div>
    <livewire:admin.transactions.orders.delete />
    <livewire:admin.transactions.orders.deliver />
</x-admin-header>
