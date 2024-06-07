<x-admin-header title="Productos">
    @can('products.create')
        <x-slot name="header">
            <a href="{{ route('products.create') }}" tabindex="-1">
                <x-button color="yellow" class="!px-10 !py-3">
                    Crear
                </x-button>
            </a>
        </x-slot>
    @endcan
    <div class="p-6">
        <livewire:admin.parameters.products.read />
    </div>
    <livewire:admin.parameters.products.delete />
</x-admin-header>
