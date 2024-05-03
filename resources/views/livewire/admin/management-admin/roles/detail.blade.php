<div class="p-6">
    <livewire:admin.management-admin.roles.delete redirect="roles.index">
        <x-detail-show>
            <div>
                <x-detail-row title="ID">
                    <p>{{ $role->id }}</p>
                </x-detail-row>

                <x-detail-row title="Nombre">
                    <p>{{ $role->name }}</p>
                </x-detail-row>

                <x-detail-row title="Fecha de registro">
                    <x-date-format>{{ $role->created_at }}</x-date-format>
                </x-detail-row>

                <x-detail-row title="Fecha de modificación">
                    <x-date-format>{{ $role->updated_at }}</x-date-format>
                </x-detail-row>

                <x-detail-row title="Permisos" classContent="flex flex-wrap -mx-2 mt-2" isResponsive>
                    @foreach ($permissions as $module => $modulePermissions)
                        <x-permissions-card>
                            <x-slot name="header">
                                {{ $module }}
                            </x-slot>
                            @foreach ($modulePermissions as $permission)
                                <li class="flex items-center mb-2">

                                    {{ $permission['description'] }}
                                </li>
                            @endforeach
                        </x-permissions-card>
                    @endforeach
                </x-detail-row>
            </div>
            <x-slot name="actions">
                <x-item-actions :actions="$actions" routesPrefix="roles" item_id="{{ $role->id }}" />
            </x-slot>
        </x-detail-show>
</div>
