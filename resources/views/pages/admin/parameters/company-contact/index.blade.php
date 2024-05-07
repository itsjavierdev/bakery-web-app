<x-admin-header title="Información de la empresa">
    <x-slot name="header">
        <a href="{{ route('company-contact.edit') }}" tabindex="-1">
            <x-button color="yellow" class="!px-10 !py-3">
                Editar
            </x-button>
        </a>
    </x-slot>
    <div class="p-6">
        <livewire:admin.parameters.company-contact.read />
    </div>
</x-admin-header>
