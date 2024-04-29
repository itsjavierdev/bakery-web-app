<div class="p-6">
    <livewire:admin.sales.delete redirect="pedidos.index" />
    <x-detail-show>
        <div>
            <x-detail-row title="ID">
                <p>{{ $sale->id }}</p>
            </x-detail-row>

            <x-detail-row title="Cliente">
                <p>{{ $sale->customer->name }} {{ $sale->customer->surname }}</p>
            </x-detail-row>

            <x-detail-row title="Personal">
                <p>{{ $sale->staff->name }} {{ $sale->staff->surname }}</p>
            </x-detail-row>

            <x-detail-row isResponsive title="Productos" classContent="flex flex-wrap gap-4">
                <x-table class="mt-2">
                    <thead class="border-b-medium border-gray-300">
                        <tr>
                            <x-th>Producto</x-th>
                            <x-th>Precio</x-th>
                            <x-th>Cantidad</x-th>
                            <x-th>Paquete</x-th>
                            <x-th>Subtotal</x-th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sale_detail as $detail)
                            <x-tr>
                                <td class="p-2">
                                    {{ $products->where('id', $detail->product_id)->first()->name }}
                                </td>

                                <td class="p-2">
                                    {{ $detail->product_price }}
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
                            <td class="p-2" colspan="4">
                                TOTAL
                            </td>
                            <td class="p-2">
                                {{ $sale->total }}
                            </td>
                        </x-tr>
                    </tfoot>
                </x-table>
            </x-detail-row>
            <x-detail-row title="Deuda">
                <x-columns.orders.paid-info value="{{ $debt }}"></x-columns.orders.paid-info>
            </x-detail-row>
            <x-detail-row title="Fecha de registro">
                <x-date-format>{{ $sale->created_at }}</x-date-format>
            </x-detail-row>
            <x-detail-row title="Fecha de modificación">
                <x-date-format>{{ $sale->updated_at }}</x-date-format>
            </x-detail-row>

        </div>
        <x-slot name="actions">
            <x-item-actions :actions="$actions" routesPrefix="ventas" item_id="{{ $sale->id }}" />
        </x-slot>
    </x-detail-show>
</div>
