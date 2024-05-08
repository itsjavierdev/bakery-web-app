<x-admin-header title="Imágenes destacadas">
    <x-slot name="header">
        <a href="{{ route('featured.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.parameters.featured.read />
    </div>
    <livewire:admin.parameters.featured.delete />
</x-admin-header>
