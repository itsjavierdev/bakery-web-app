<x-app-header title="Productos">
    <x-slot name="header">
        <a href="{{ route('productos.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:products.read />
    </div>
    <livewire:products.delete />
</x-app-header>
