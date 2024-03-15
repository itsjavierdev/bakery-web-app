<x-app-header title="Roles">
    <x-slot name="header">
        <a href="{{ route('roles.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:roles.read />
    </div>
    <livewire:roles.delete />
</x-app-header>
