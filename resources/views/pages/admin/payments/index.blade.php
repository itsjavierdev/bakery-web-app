<x-admin-header title="Pagos">
    <x-slot name="header">
        <a href="{{ route('pagos.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.payments.read />
    </div>
    <livewire:admin.payments.delete />
</x-admin-header>
