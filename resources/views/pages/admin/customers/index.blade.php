<x-admin-header title="Clientes">
    <x-slot name="header">
        <a href="{{ route('clientes.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.customers.read />
    </div>
</x-admin-header>
