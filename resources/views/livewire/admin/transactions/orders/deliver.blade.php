<x-dialog-modal wire:model="open">
    <x-slot name="title">
        Enviar pedido
        <hr class="mt-2">
    </x-slot>
    <x-slot name="content">
        @if ($order)
            <div class="flex flex-col gap-3">
                <x-inputs.disabled title="Cliente">
                    <p>{{ $order->customer->name }},</p>
                    <p>{{ $order->customer->phone }},</p>
                    <p>{{ $order->customer->email }}</p>
                </x-inputs.disabled>
                @if ($order->address)
                    <x-inputs.disabled title="Dirección">
                        <p>{{ $order->address->address }}</p>
                    </x-inputs.disabled>
                @endif
                <div class="flex flex-row gap-3 w-full">
                    <x-inputs.disabled title="Fecha entrega" class="w-full">
                        <p>{{ $order->delivery_date }}</p>
                    </x-inputs.disabled>
                    <x-inputs.disabled title="Hora entrega" class="w-full">
                        <p>{{ $order->deliveryTime->time }}</p>
                    </x-inputs.disabled>
                </div>
                @if ($order->notes)
                    <x-inputs.disabled title="Notas">
                        <p>{{ $order->notes }}</p>
                    </x-inputs.disabled>
                @endif
                <div class="w-full">
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
                            @foreach ($order_details as $detail)
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
                                    {{ $order->total }}
                                </td>
                            </x-tr>
                        </tfoot>
                    </x-table>
                </div>

                <div class="flex flex-row gap-3 w-full">
                    <x-inputs.disabled title="Pagos" class="w-full">
                        <p>{{ $order->paid_amount }}</p>
                    </x-inputs.disabled>
                    <x-inputs.disabled title="Deuda" class="w-full">
                        <p>{{ $debt }}</p>
                    </x-inputs.disabled>
                </div>
                <!--Pay balance-->
                <x-inputs.group>
                    <x-inputs.label value="Pago de saldo" />
                    <x-inputs.text type="number" wire:model.change="new_paid" :disabled="$paid_all ? true : false" />
                    <x-inputs.error for="new_paid" />
                    <x-inputs.label class="mt-2">
                        <x-inputs.checkbox class="mr-2 mb-0.5" wire:model.change="paid_all" />
                        <span>Todo el saldo</span>
                    </x-inputs.label>
                </x-inputs.group>
            </div>
        @endif
    </x-slot>
    <x-slot name="footer">
        <div class="flex flex-row-reverse justify-between w-full">
            <x-button wire:click="deliver" wire:loading.attr="disabled">
                Enviar
            </x-button>
            <x-secondary-button wire:click="$set('open', false)" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
        </div>
    </x-slot>
</x-dialog-modal>
