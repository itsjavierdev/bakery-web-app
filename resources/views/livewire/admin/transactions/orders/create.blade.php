<x-form-template>
    <div class="flex flex-col lg:flex-row gap-5 lg:gap-10">
        <!--Data-->
        <div class="w-full">
            <!--Customer Info-->
            <h3 class="w-full text-center">Información del cliente</h3>
            <x-inputs.group>
                <!--Select Customer or add a name-->
                <x-inputs.label value="Cliente" is_required />
                <div class="flex gap-2">
                    <x-inputs.text wire:model="customer.name" :disabled="$add_customer ? false : true" />
                    <x-secondary-button wire:click="toggleModal('cliente')" tabindex="-1"><i
                            class="icon-bars text-2xl"></i></x-secondary-button>
                    @if ($add_customer)
                        <x-secondary-button wire:click="$set('add_customer', false)" tabindex="-1"><i
                                class="icon-minus text-2xl"></i></x-secondary-button>
                    @else
                        <x-secondary-button wire:click="$set('add_customer', true)" tabindex="-1"><i
                                class="icon-plus text-2xl"></i></x-secondary-button>
                    @endif
                </div>
                <x-inputs.error for="customer.name" />
            </x-inputs.group>
            <!--Add customer form-->
            @if ($add_customer)
                <div class="pb-2">
                    <!--Surname-->
                    <x-inputs.group>
                        <x-inputs.label value="Apellido" is_required />
                        <x-inputs.text wire:model="customer.surname" />
                        <x-inputs.error for="customer.surname" />
                    </x-inputs.group>
                    <!--Phone-->
                    <x-inputs.group>
                        <x-inputs.label value="Telefono" is_required />
                        <x-inputs.text wire:model="customer.phone" />
                        <x-inputs.error for="customer.phone" />
                    </x-inputs.group>
                    <!--Email-->
                    <x-inputs.group>
                        <x-inputs.label value="Correo electronico" />
                        <x-inputs.text wire:model="customer.email" />
                        <x-inputs.error for="customer.email" />
                    </x-inputs.group>
                </div>
            @endif
            <hr class="my-3">
            <!--Delivery info-->
            <h3 class="w-full text-center">Información del entrega</h3>
            <x-inputs.label value="Metodo de entrega" is_required />
            <div class="flex  justify-around gap-3 my-3">
                <!--Select delivery method-->
                @if ($delivery == 'delivery')
                    <x-button class="!w-full justify-center" wire:click="updateDelivery('delivery')">Envio a
                        domicilio</x-button>
                    <x-secondary-button class="!w-full justify-center" wire:click="updateDelivery('pickup')">Recogida en
                        sucursal</x-secondary-button>
                @elseif ($delivery == 'pickup')
                    <x-secondary-button class="!w-full justify-center" wire:click="updateDelivery('delivery')">Envio a
                        domicilio</x-secondary-button>
                    <x-button class="!w-full justify-center" wire:click="updateDelivery('pickup')">Recogida
                        en
                        sucursal</x-button>
                @else
                    <x-secondary-button class="!w-full justify-center" wire:click="updateDelivery('delivery')">Envio a
                        domicilio</x-secondary-button>
                    <x-secondary-button class="!w-full justify-center" wire:click="updateDelivery('pickup')">Recogida en
                        sucursal</x-secondary-button>
                @endif
            </div>
            <!--Select or add Address-->
            @if ($delivery == 'delivery')
                <x-inputs.group>
                    <x-inputs.label value="Dirección" is_required />
                    <div class="flex gap-2">
                        <x-inputs.text wire:model="address.address" :disabled="$add_address ? false : true" />
                        <x-secondary-button wire:click="toggleModal('dirección')" tabindex="-1"><i
                                class="icon-bars text-2xl"></i></x-secondary-button>
                        @if ($add_address)
                            <x-secondary-button wire:click="$set('add_address', false)" tabindex="-1"><i
                                    class="icon-minus text-2xl"></i></x-secondary-button>
                        @else
                            <x-secondary-button wire:click="$set('add_address', true)" tabindex="-1"><i
                                    class="icon-plus text-2xl"></i></x-secondary-button>
                        @endif
                    </div>
                    <x-inputs.error for="address.address" />
                </x-inputs.group>
                <!--Add address form-->
                @if ($add_address)
                    <div class="pb-2">
                        <!--Reference-->
                        <x-inputs.group>
                            <x-inputs.label value="Referencia" />
                            <x-inputs.text wire:model="address.reference" />
                            <x-inputs.error for="address.reference" />
                        </x-inputs.group>
                    </div>
                @endif
            @endif
            <!--Date-->
            <x-inputs.group>
                <div class="flex flex-row gap-4 *:w-full">
                    <div>
                        <x-inputs.label value="Fecha de entrega" is_required />
                        <x-inputs.date class="mt-2" wire:model="delivery_date" />
                        <x-inputs.error for="delivery_date" />
                    </div>
                    <div>
                        <x-inputs.label value="Hora de entrega" is_required />
                        <x-inputs.select class="mt-2" wire:model="delivery_time" :disabled="$delivery ? false : true">
                            <option value="">Seleccionar</option>
                            @if ($delivery == 'pickup')
                                @foreach ($delivery_times as $time)
                                    <option value="{{ $time->id }}">
                                        {{ Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('H:i') }}
                                    </option>
                                @endforeach
                            @else
                                @foreach ($delivery_times_free as $time)
                                    <option value="{{ $time->id }}">
                                        {{ Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('H:i') }}
                                    </option>
                                @endforeach
                            @endif
                        </x-inputs.select>
                        <x-inputs.error for="delivery_time" />
                    </div>
                </div>
                <x-inputs.error for="delivery_date_time" />
            </x-inputs.group>
            <hr class="my-3">
            <!--Comments-->
            <x-inputs.group>
                <x-inputs.label value="Nota" />
                <x-inputs.textarea wire:model="notes" />
                <x-inputs.error for="notes" />
            </x-inputs.group>
            <!--Paid amount-->
            <x-inputs.group>
                <x-inputs.label value="Total pagado" />
                <x-inputs.text type="number" wire:model.change="total_paid" :disabled="$paid ? true : false" />
                <x-inputs.error for="total_paid" />
                <x-inputs.label class="mt-2">
                    <x-inputs.checkbox class="mr-2 mb-0.5" wire:model.change="paid" />
                    <span>Todo pagado</span>
                </x-inputs.label>
            </x-inputs.group>
        </div>
        <!--Detail-->
        <div class="w-full">
            <h3 class="w-full text-center mb-6">Detalle de productos <span class="text-red-500">*</span></h3>
            <x-inputs.group>

                <div>
                    <x-table>
                        <thead class="border-b-medium border-gray-300">
                            <tr>
                                <x-th>Producto</x-th>
                                <x-th>Precio</x-th>
                                <x-th>Cantidad</x-th>
                                <x-th>Paquete</x-th>
                                <x-th>Subtotal</x-th>
                                <x-th></x-th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $index => $product)
                                <x-tr>
                                    <td class="p-2">
                                        {{ $product['name'] }}
                                    </td>

                                    <td class="p-2">
                                        {{ $product['price'] }}
                                    </td>
                                    <td class="p-2">
                                        <x-inputs.text type="number"
                                            wire:model.change="products.{{ $index }}.quantity" />
                                    </td>
                                    <td class="p-2 h-full">
                                        <div class="flex items-center justify-center">
                                            <x-inputs.checkbox
                                                wire:model.change="products.{{ $index }}.by_bag" />
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        {{ $product['subtotal'] }}

                                    </td>

                                    <td class="p-2">
                                        <x-button-rounded wire:click="deleteProduct('{{ $product['id'] }}')">
                                            <i class="icon-trash text-2xl text-red-700"></i>
                                        </x-button-rounded>
                                    </td>
                                </x-tr>
                            @endforeach
                        </tbody>

                        <tfoot class="border-t-medium border-gray-300 bg-gray-100">
                            <x-tr>
                                <td class="px-2" colspan="4">
                                    {{ $total ? 'TOTAL' : '' }}
                                </td>
                                <td class="px-2">
                                    {{ $total ? $total : '' }}
                                </td>
                                <td class="px-2">
                                    <x-button-rounded wire:click="toggleModal('productos')">
                                        <i class="icon-plus text-2xl text-blue-500"></i>
                                    </x-button-rounded>
                                </td>
                            </x-tr>
                        </tfoot>

                    </x-table>
                </div>
                <x-inputs.error for="products" />
                <x-inputs.error for="products.*.quantity" />
            </x-inputs.group>
        </div>
    </div>
    <!--Actions-->
    <x-slot name="footer">
        <x-button wire:click="save" wire:loading.attr="disabled">
            Crear
        </x-button>
        <a href="{{ route('orders.index') }}">
            <x-secondary-button>
                Cancelar
            </x-secondary-button>
        </a>
    </x-slot>

    <!--Add customer, address, product modal-->
    <x-dialog-modal wire:model=open>
        <x-slot name="title">
            <h2 class="text-lg font-semibold">Seleccionar {{ $select }}</h2>
        </x-slot>
        <x-slot name=content>
            @if ($select == 'cliente')
                <livewire:admin.management-customers.customers.read add />
            @elseif ($select == 'dirección')
                <livewire:admin.management-customers.addresses.select add customer_id="{{ $customer['id'] }}" />
            @else
                <livewire:admin.transactions.orders.products add />
            @endif
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end w-full">
                <x-secondary-button wire:click="toggleModal('')">Cancelar</x-secondary-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</x-form-template>
