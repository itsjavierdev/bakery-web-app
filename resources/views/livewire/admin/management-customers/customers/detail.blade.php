<div class="p-6">
    <livewire:admin.management-customers.customers.delete redirect="customers.index">
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

                <x-detail-row title="Aprobado">
                    <x-columns.boolean value="{{ $customer->verified }}" />
                </x-detail-row>

                <x-detail-row title="Direcciones" classContent="flex flex-wrap -mx-2 mt-2" isResponsive>
                    @foreach ($addresses as $address)
                        <x-permissions-card>
                            <x-slot name="header">
                                <div>
                                </div>
                            </x-slot>
                            <p>{{ $address->address }}</p>
                            <p class="text-gray-600">{{ $address->reference }}</p>
                        </x-permissions-card>
                    @endforeach
                </x-detail-row>

                <x-detail-row title="Fecha de registro">
                    <x-date-format>{{ $customer->created_at }}</x-date-format>
                </x-detail-row>
            </div>
            <x-slot name="actions">
                <x-item-actions :actions="$actions" routesPrefix="customers" item_id="{{ $customer->id }}" />
            </x-slot>
        </x-detail-show>
</div>
