<div class="p-6">
    <livewire:staff.delete redirect="personal.index">
        <x-detail-show>
            <div>
                <x-detail-row title="ID">
                    <p>{{ $staff->id }}</p>
                </x-detail-row>
                <x-detail-row title="Nombre">
                    <p>{{ $staff->name }}</p>
                </x-detail-row>
                <x-detail-row title="Apellido">
                    <p>{{ $staff->surname }}</p>
                </x-detail-row>
                <x-detail-row title="Telefono">
                    <p>{{ $staff->phone }}</p>
                </x-detail-row>
                <x-detail-row title="Carnet de identidad">
                    <p>{{ $staff->CI }}</p>
                </x-detail-row>
                <x-detail-row title="Fecha de nacimiento">
                    <x-date-format>{{ $staff->birthdate }}</x-date-format>
                </x-detail-row>
                <x-detail-row title="Empleado en la empresa">
                    @if ($staff->is_employed)
                        <i class="icon-check text-green-500 text-lg"></i>
                    @else
                        <i class="icon-x text-red-500 text-lg"></i>
                    @endif
                </x-detail-row>
                <x-detail-row title="Fecha de registro">
                    <x-date-format>{{ $staff->created_at }}</x-date-format>
                </x-detail-row>
                <x-detail-row title="Fecha de modificación">
                    <x-date-format>{{ $staff->updated_at }}</x-date-format>
                </x-detail-row>
                @if ($this->user)
                    <x-detail-row title="Correo electronico">
                        <p>{{ $user->email }}</p>
                    </x-detail-row>
                    <x-detail-row title="Rol">
                        <p>{{ $role->name }}</p>
                    </x-detail-row>
                @endif
            </div>
            <x-slot name="actions">
                <x-item-actions :actions="$actions" routesPrefix="personal" item_id="{{ $staff->id }}" />
            </x-slot>
        </x-detail-show>
</div>
