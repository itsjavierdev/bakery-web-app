<x-form-template>
    <!--Info-->
    <x-inputs.group>
        <x-inputs.disabled title="Codigo Venta" class="w-full">
            <p>{{ $sale->id }}</p>
        </x-inputs.disabled>
        @if ($sale->customer)
            <x-inputs.disabled title="Cliente" class="w-full">
                <p>{{ $sale->customer->name }} {{ $sale->customer->surname }}</p>
            </x-inputs.disabled>
        @endif
    </x-inputs.group>
    <!--Detail-->
    <div class="w-full">
        <x-inputs.group>
            <x-inputs.label value="Detalle" />
            <div>
                <x-table>
                    <thead class="border-b-medium border-gray-300">
                        <tr>
                            <x-th>Fecha</x-th>
                            <x-th>Personal</x-th>
                            <x-th>Monto</x-th>
                            <x-th></x-th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($payments as $index => $payment)
                            <x-tr>
                                <td class="p-2">
                                    <x-date-format>
                                        {{ $payment['created_at'] }}
                                    </x-date-format>
                                </td>

                                <td class="p-2">
                                    @if ($payment['staff_name'])
                                        {{ $payment['staff_name'] }} {{ $payment['staff_surname'] }}
                                    @endif
                                </td>

                                <td class="p-2">
                                    <x-inputs.text type="number"
                                        wire:model.change="payments.{{ $index }}.amount" />
                                </td>

                                <td class="p-2">
                                    <x-button-rounded wire:click="deletePayment('{{ $payment['id'] }}')">
                                        <i class="icon-trash text-2xl text-red-700"></i>
                                    </x-button-rounded>
                                </td>
                            </x-tr>
                        @endforeach
                    </tbody>

                    <tfoot class="border-t-medium border-gray-300 bg-gray-100">
                        <x-tr>
                            <td class="px-2" colspan="2">
                                {{ $total ? 'TOTAL' : '' }}
                            </td>
                            <td class="px-2">
                                {{ $total ? $total : '' }}
                            </td>
                            <td class="px-2">

                            </td>
                        </x-tr>
                    </tfoot>
                </x-table>
            </div>
            <x-inputs.error for="payments.*.amount"></x-inputs.error>
            <x-inputs.error for="total"></x-inputs.error>
        </x-inputs.group>
    </div>
    <!--Totals-->
    <x-inputs.group>
        <div class="flex flex-row gap-3 w-full">
            <x-inputs.disabled title="Total de la venta" class="w-full">
                <p>{{ $sale->total }}</p>
            </x-inputs.disabled>
            <x-inputs.disabled title="Saldo" class="w-full">
                <p>{{ $remaining_amount }}</p>
            </x-inputs.disabled>
        </div>
    </x-inputs.group>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="update" wire:loading.attr="disabled">
            Actualizar
        </x-button>
        <a href="{{ route('payments.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>


</x-form-template>
