<div class="p-6">
    <livewire:admin.transactions.orders.delete redirect="orders.index" />
    <livewire:admin.transactions.orders.deliver />
    <x-detail-show>
        <div>
            <x-detail-row title="ID">
                <p>{{ $order->id }}</p>
            </x-detail-row>
            <x-detail-row title="Fecha de entrega">
                <x-date-format>{{ $order->created_at }}</x-date-format>
            </x-detail-row>
            <x-detail-row title="Hora de entrega">
                <x-columns.time value="{{ $order->deliveryTime->time }}" />
            </x-detail-row>
            <x-detail-row title="Cliente">
                <p>{{ $order->customer->name }} {{ $order->customer->surname }}</p>
            </x-detail-row>
            <x-detail-row title="Información de contacto">
                <p>{{ $order->customer->phone }}</p>
                <p>{{ $order->customer->email }}</p>
            </x-detail-row>
            <x-detail-row title="Dirección">
                @if ($order->address->address ?? false)
                    <x-permissions-card class="-mx-2">
                        <x-slot name="header">
                            <div>
                            </div>
                        </x-slot>
                        <p>{{ $order->address->address }}</p>
                        <p class="text-gray-600">{{ $order->address->reference }}</p>
                    </x-permissions-card>
                @endif
            </x-detail-row>
            <x-detail-row isResponsive title="Productos" classContent="flex flex-wrap gap-4">
                <x-table class="mt-2">
                    <thead class="border-b-medium border-gray-300">
                        <tr>
                            <x-th>Producto</x-th>
                            <x-th>Precio</x-th>
                            <x-th>Precio Bolsa</x-th>
                            <x-th>Cantidad</x-th>
                            <x-th>Paquete</x-th>
                            <x-th>Subtotal</x-th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order_detail as $detail)
                            <x-tr>
                                <td class="p-2">
                                    {{ $products->where('id', $detail->product_id)->first()->name }}
                                </td>

                                <td class="p-2">
                                    {{ $detail->product_price }}
                                </td>
                                <td class="p-2">
                                    {{ $products->where('id', $detail->product_id)->first()->price_by_bag }}
                                </td>
                                <td class="p-2">
                                    {{ $detail->quantity }}
                                </td>
                                <td class="p-2 flex items-center justify-center">
                                    {{ $detail->by_bag ? 'Si' : 'No' }}
                                </td>
                                <td class="p-2">
                                    {{ $detail->subtotal }}

                                </td>
                            </x-tr>
                        @endforeach
                    </tbody>

                    <tfoot class="border-t-medium border-gray-300 bg-gray-100">
                        <x-tr>
                            <td class="p-2" colspan="5">
                                TOTAL
                            </td>
                            <td class="p-2">
                                {{ $order->total }}
                            </td>
                        </x-tr>
                    </tfoot>
                </x-table>
            </x-detail-row>
            <x-detail-row title="Deuda">
                <x-columns.orders.paid-info value="{{ $debt }}"></x-columns.orders.paid-info>
            </x-detail-row>
            <x-detail-row isResponsive title="Nota">
                <p>{{ $order->notes }}</p>
            </x-detail-row>
            <x-detail-row title="Fecha de registro">
                <x-date-format>{{ $order->created_at }}</x-date-format>
            </x-detail-row>

        </div>
        <x-slot name="actions">
            <x-item-actions :actions="$actions" routesPrefix="orders" item_id="{{ $order->id }}" />
        </x-slot>
    </x-detail-show>
</div>
