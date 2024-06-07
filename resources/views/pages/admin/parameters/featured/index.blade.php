<x-admin-header title="Imágenes destacadas">
    @canany(['featured.create', 'featured.update'])
        <x-slot name="header">
            <div class="flex gap-2">
                @can('featured.update')
                    <a href="{{ route('featured.reorder') }}" tabindex="-1">
                        <x-secondary-button class="!px-4 !py-3">
                            Reordenar
                        </x-secondary-button>
                    </a>
                @endcan
                @can('featured.create')
                    <a href="{{ route('featured.create') }}" tabindex="-1">
                        <x-button color="yellow" class="!px-10 !py-3">
                            Crear
                        </x-button>
                    </a>
                @endcan
            </div>
        </x-slot>
    @endcanany
    <div class="p-6">
        <livewire:admin.parameters.featured.read />
    </div>
    <livewire:admin.parameters.featured.delete />
</x-admin-header>
