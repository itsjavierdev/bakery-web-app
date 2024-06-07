<x-admin-header title="Horarios de entrega">
    @can('deliverytimes.create')
        <x-slot name="header">
            <a href="{{ route('deliverytimes.create') }}" tabindex="-1">
                <x-button color="yellow" class="!px-10 !py-3">
                    Crear
                </x-button>
            </a>
        </x-slot>
    @endcan

    <div class="p-6">
        <livewire:admin.parameters.delivery-times.read />
    </div>
    <livewire:admin.parameters.delivery-times.delete />
</x-admin-header>
