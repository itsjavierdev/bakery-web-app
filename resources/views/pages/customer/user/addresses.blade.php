<x-customer>
    @push('pageTitle', 'Mis direcciones')
    <div>
        <x-title>Mis Direcciones</x-tite>
    </div>
    <div>
        <livewire:customer.addresses.read />
    </div>
</x-customer>
