<x-admin-header title="Categorias">
    <x-slot name="header">
        <a href="{{ route('categories.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.parameters.categories.read />
    </div>
    <livewire:admin.parameters.categories.delete />
</x-admin-header>
