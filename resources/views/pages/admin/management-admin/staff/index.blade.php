<x-admin-header title="Personal">
    <x-slot name="header">
        <a href="{{ route('staff.create') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Crear
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.management-admin.staff.read />
    </div>
    <livewire:admin.management-admin.staff.delete />
</x-admin-header>
