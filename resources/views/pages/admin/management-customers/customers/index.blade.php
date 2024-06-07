<x-admin-header title="Clientes">
    @can('customers.create')
        <x-slot name="header">
            <a href="{{ route('customers.create') }}" tabindex="-1">
                <x-button color="yellow" class="!px-10 !py-3">
                    Crear
                </x-button>
            </a>
        </x-slot>
    @endcan
    <div class="p-6">
        <livewire:admin.management-customers.customers.read />
    </div>
    <livewire:admin.management-customers.customers.delete />
</x-admin-header>
