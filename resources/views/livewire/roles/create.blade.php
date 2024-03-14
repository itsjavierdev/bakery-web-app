<x-form-template>
    <div class="mb-4 max-w-2xl">
        <x-inputs.label value="Nombre" />
        <x-inputs.text class="w-full mt-2" wire:model="name" />
        <x-inputs.error for="name" />

    </div>
    <div>
        <h3>Permisos</h3>
        <div class="flex flex-wrap -mx-2 mt-2">
            @foreach ($permissions as $module => $modulePermissions)
                <x-permissions-card>
                    <x-slot name="header">
                        <x-inputs.checkbox type="checkbox" class="mr-2 module-checkbox"
                            data-module="{{ $module }}" />
                        {{ $module }}
                    </x-slot>
                    @foreach ($modulePermissions as $permission)
                        <li class="flex items-center mb-2">
                            <x-inputs.checkbox name="roles" wire:model="selected_permissions"
                                value="{{ $permission['id'] }}" class="mr-2 permission-checkbox"
                                data-module="{{ $module }}" />
                            <span>{{ $permission['description'] }}</span>
                        </li>
                    @endforeach
                </x-permissions-card>
            @endforeach
        </div>
        <x-inputs.error for="selected_permissions" />
    </div>
    <x-slot name="footer">
        <x-button wire:click="save">
            Crear
        </x-button>
        <a href="{{ route('roles.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>

@push('js')
    @vite('resources/js/selectAllPermissions.js')
@endpush
