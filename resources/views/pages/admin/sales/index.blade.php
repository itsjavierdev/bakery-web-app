<x-admin-header title="Ventas">
    <x-slot name="header">
        <a href="{{ route('ventas.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.sales.read />
    </div>
    <livewire:admin.sales.delete />
</x-admin-header>
