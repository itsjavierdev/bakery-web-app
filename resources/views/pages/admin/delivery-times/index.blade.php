<x-admin-header title="Horarios de entrega">
    <x-slot name="header">
        <a href="{{ route('horarios.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.delivery-times.read />
    </div>
    <livewire:admin.delivery-times.delete />
</x-admin-header>
