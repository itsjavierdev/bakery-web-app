<div class="p-6">
    <x-detail-show>
        <div>
            <x-detail-row title="Codigo venta">
                <p>{{ $sale->id }}</p>
            </x-detail-row>
            <x-detail-row title="Cliente">
                <p>{{ $sale->customer->name }} {{ $sale->customer->surname }}</p>
            </x-detail-row>
            <x-detail-row isResponsive title="Pagos" classContent="flex flex-wrap gap-4">
                <x-table class="mt-2 w-full">
                    <thead class="border-b-medium border-gray-300">
                        <tr>
                            <x-th>Fecha</x-th>
                            <x-th>Personal</x-th>
                            <x-th>Monto</x-th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($payments as $index => $payment)
                            <x-tr>
                                <td class="p-2">
                                    <x-date-format>
                                        {{ $payment->created_at }}
                                    </x-date-format>
                                </td>

                                <td class="p-2">
                                    {{ $payment->staff->name }} {{ $payment->staff->surname }}
                                </td>

                                <td class="p-2">
                                    {{ $payment->amount }}
                                </td>

                            </x-tr>
                        @endforeach
                    </tbody>

                    <tfoot class="border-t-medium border-gray-300 bg-gray-100">
                        <x-tr>
                            <td class="px-2" colspan="2">
                                TOTAL
                            </td>
                            <td class="px-2">
                                {{ $sale->paid_amount }}
                            </td>
                        </x-tr>
                    </tfoot>
                </x-table>
            </x-detail-row>
            <x-detail-row title="Total de la venta">
                <p>Bs {{ $sale->total }}</p>
            </x-detail-row>

            <x-detail-row title="Saldo">
                <p>Bs {{ $remaining_amount }}</p>
            </x-detail-row>

            <x-detail-row title="Fecha de la venta">
                <x-date-format>{{ $sale->created_at }}</x-date-format>
            </x-detail-row>
        </div>
        <x-slot name="actions">
            <x-item-actions :actions="$actions" routesPrefix="pagos" item_id="{{ $sale->id }}" />
        </x-slot>
    </x-detail-show>
</div>
