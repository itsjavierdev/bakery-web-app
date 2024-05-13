<x-admin-header title="Ventas">
    <x-slot name="header">

        <a href="{{ route('sales.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.transactions.sales.read />
    </div>
    <livewire:admin.transactions.sales.delete />
</x-admin-header>
