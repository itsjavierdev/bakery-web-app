<x-admin-header title="Categorias">
    <x-slot name="header">
        <a href="{{ route('categorias.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.categories.read />
    </div>
    <livewire:admin.categories.delete />
</x-admin-header>
