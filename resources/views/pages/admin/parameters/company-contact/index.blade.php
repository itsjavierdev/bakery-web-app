<x-admin-header title="Información de la empresa">
    @can('companycontact.update')
        <x-slot name="header">
            <a href="{{ route('companycontact.edit') }}" tabindex="-1">
                <x-button color="yellow" class="!px-10 !py-3">
                    Editar
                </x-button>
            </a>
        </x-slot>
    @endcan
    <div class="p-6">
        <livewire:admin.parameters.company-contact.read />
    </div>
</x-admin-header>
