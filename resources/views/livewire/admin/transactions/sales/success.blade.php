<x-form-template>
    <livewire:admin.reports.vouchers.sale-voucher />
    <x-inputs.group>
        <x-inputs.disabled title="Cliente">
            <p>{{ $sale->customer->name . ' ' . $sale->customer->surname }}</p>
        </x-inputs.disabled>
    </x-inputs.group>

    <x-inputs.group>
        <x-inputs.disabled title="Personal">
            <p>{{ $sale->staff->name . ' ' . $sale->staff->surname }}</p>
        </x-inputs.disabled>
    </x-inputs.group>

    <x-inputs.group>
        <x-inputs.label value="Detalle" />
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
    </x-inputs.group>


    <x-inputs.group>
        <x-inputs.disabled title="Deuda">
            <x-columns.orders.paid-info value="{{ $debt }}"></x-columns.orders.paid-info>
        </x-inputs.disabled>
    </x-inputs.group>

    <x-slot name="footer">
        <x-button wire:loading.attr="disabled" wire:click="$dispatch('generateSale', {id: {{ $sale->id }}})">
            Generar comprobante
        </x-button>
        <a href="{{ route('sales.index') }}">
            <x-secondary-button>
                Volver a ventas
            </x-secondary-button>
        </a>
    </x-slot>
</x-form-template>
