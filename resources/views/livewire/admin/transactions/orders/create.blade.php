<x-form-template>
    <div class="flex flex-col lg:flex-row gap-5 lg:gap-10">
        <!--Data-->
        <div class="w-full">
            <!--Customer-->
            <x-inputs.group>
                <x-inputs.label value="Cliente" />
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
            @if ($add_customer)
                <div class="pb-2">
                    <!--Surname-->
                    <x-inputs.group>
                        <x-inputs.label value="Apellido" />
                        <x-inputs.text wire:model="customer.surname" />
                        <x-inputs.error for="customer.surname" />
                    </x-inputs.group>
                    <!--Phone-->
                    <x-inputs.group>
                        <x-inputs.label value="Telefono" />
                        <x-inputs.text wire:model="customer.phone" />
                        <x-inputs.error for="customer.phone" />
                    </x-inputs.group>
                    <!--Email-->
                    <x-inputs.group>
                        <x-inputs.label value="Correo electronico" />
                        <x-inputs.text wire:model="customer.email" />
                        <x-inputs.error for="customer.email" />
                    </x-inputs.group>
                    <hr>
                </div>
            @endif
            <!--Address-->
            <x-inputs.group>
                <x-inputs.label value="Dirección" />
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
            @if ($add_address)
                <div class="pb-2">
                    <!--Reference-->
                    <x-inputs.group>
                        <x-inputs.label value="Referencia" />
                        <x-inputs.text wire:model="address.reference" />
                        <x-inputs.error for="address.reference" />
                    </x-inputs.group>
                    <hr>
                </div>
            @endif
            <!--Date-->
            <x-inputs.group>
                <div class="flex flex-row gap-4 *:w-full">
                    <div>
                        <x-inputs.label value="Fecha de entrega" />
                        <x-inputs.date class="mt-2" wire:model="delivery_date" />
                        <x-inputs.error for="delivery_date" />
                    </div>
                    <div>
                        <x-inputs.label value="Hora de entrega" />
                        <x-inputs.select class="mt-2" wire:model="delivery_time">
                            <option value="">Seleccionar</option>
                            @foreach ($delivery_times as $delivery_time)
                                <option value="{{ $delivery_time->id }}">
                                    {{ Carbon\Carbon::createFromFormat('H:i:s', $delivery_time->time)->format('h:i') }}
                                    {{ $delivery_time->available ? 'Gratis' : '' }}</option>
                            @endforeach
                        </x-inputs.select>
                        <x-inputs.error for="delivery_time" />
                    </div>
                </div>
            </x-inputs.group>
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
            <x-inputs.group>
                <x-inputs.label value="Detalle" />
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
        <x-button wire:click="save">
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
        {{ $select }}
        <x-slot name="title">
            <h2 class="text-lg font-semibold">Seleccionar {{ $select }}</h2>
        </x-slot>
        <x-slot name=content>
            @if ($select == 'cliente')
                <livewire:admin.management-customers.customers.read add />
            @elseif ($select == 'dirección')
                <livewire:admin.management-customers.addresses.select add customer_id="{{ $customer['id'] }}" />
            @else
                <livewire:admin.parameters.products.read add />
            @endif
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end w-full">
                <x-secondary-button wire:click="toggleModal('')">Cancelar</x-secondary-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</x-form-template>
