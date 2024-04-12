<div class="p-6">
    <livewire:admin.delivery-times.delete redirect="horarios.index">
        <x-detail-show>
            <div>
                <x-detail-row title="ID">
                    <p>{{ $delivery_time->id }}</p>
                </x-detail-row>

                <x-detail-row title="Horario">
                    <x-columns.time value="{{ $delivery_time->time }}" />
                </x-detail-row>

                <x-detail-row title="Disponible">
                    @if ($delivery_time->available)
                        <i class="icon-check text-green-500 text-lg"></i>
                    @else
                        <i class="icon-x text-red-500 text-lg"></i>
                    @endif
                </x-detail-row>

                <x-detail-row title="Fecha de registro">
                    <x-date-format>{{ $delivery_time->created_at }}</x-date-format>
                </x-detail-row>

                <x-detail-row title="Fecha de modificación">
                    <x-date-format>{{ $delivery_time->updated_at }}</x-date-format>
                </x-detail-row>
            </div>
            <x-slot name="actions">
                <x-item-actions :actions="$actions" routesPrefix="horarios" item_id="{{ $delivery_time->id }}" />
            </x-slot>
        </x-detail-show>
</div>
