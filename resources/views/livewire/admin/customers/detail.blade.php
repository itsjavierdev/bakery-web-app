<div class="p-6">
    <livewire:admin.customers.delete redirect="clientes.index">
        <x-detail-show>
            <div>
                <x-detail-row title="ID">
                    <p>{{ $customer->id }}</p>
                </x-detail-row>

                <x-detail-row title="Nombre">
                    <p>{{ $customer->name }}</p>
                </x-detail-row>

                <x-detail-row title="Apellido">
                    <p>{{ $customer->surname }}</p>
                </x-detail-row>

                <x-detail-row title="Telefono">
                    <p>{{ $customer->phone }}</p>
                </x-detail-row>

                <x-detail-row title="Correo electronico">
                    <p>{{ $customer->email }}</p>
                </x-detail-row>

                <x-detail-row title="Tiene cuenta">
                    @if ($has_account)
                        <i class="icon-check text-green-500 text-lg"></i>
                    @else
                        <i class="icon-x text-red-500 text-lg"></i>
                    @endif
                </x-detail-row>

                <x-detail-row title="Fecha de registro">
                    <x-date-format>{{ $customer->created_at }}</x-date-format>
                </x-detail-row>

                <x-detail-row title="Fecha de modificación">
                    <x-date-format>{{ $customer->updated_at }}</x-date-format>
                </x-detail-row>
            </div>
            <x-slot name="actions">
                <x-item-actions :actions="$actions" routesPrefix="clientes" item_id="{{ $customer->id }}" />
            </x-slot>
        </x-detail-show>
</div>
