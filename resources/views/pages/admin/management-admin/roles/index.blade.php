<x-admin-header title="Roles">
    @can('roles.create')
        <x-slot name="header">
            <a href="{{ route('roles.create') }}" tabindex="-1">
                <x-button color="yellow" class="!px-10 !py-3">
                    Crear
                </x-button>
            </a>
        </x-slot>
    @endcan
    <div class="p-6">
        <livewire:admin.management-admin.roles.read />
    </div>
    <livewire:admin.management-admin.roles.delete />
</x-admin-header>
