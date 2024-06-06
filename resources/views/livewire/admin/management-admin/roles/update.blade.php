<x-form-template>
    <x-inputs.group>
        <x-inputs.label value="Nombre" is_required />
        <x-inputs.text wire:model="name" />
        <x-inputs.error for="name" />

    </x-inputs.group>
    <div>
        <h3>Permisos <span class="text-red-500 text">*</span></h3>
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
        <x-button wire:click="update" wire:loading.attr="disabled">
            Actualizar
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
