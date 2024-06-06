<div class="md:flex justify-around gap-7 mx-5">
    <div class="w-full">
        <!--Customer information-->
        <div class="bg-white border border-border rounded px-5 pb-5 mb-7">
            <!--Contact information-->
            <x-checkout-section title="Información de contacto">
                <div class="flex justify-between p-3">
                    <h1>Nombre:</h1>
                    <span>{{ Auth::guard('customer')->user()->customer->name }}
                        {{ Auth::guard('customer')->user()->customer->surname }}</span>
                </div>
                <div class="flex justify-between  p-3">
                    <h1>Email:</h1>
                    <span>{{ Auth::guard('customer')->user()->customer->email }}</span>
                </div>
                <div class="flex justify-between p-3">
                    <h1>Telefono:</h1>
                    <span>{{ Auth::guard('customer')->user()->customer->phone }}</span>
                </div>
            </x-checkout-section>
            <!--Delivery info-->
            <x-checkout-section title="Información de entrega">
                <!--Pickup-->
                <div wire:click="$set('delivery', 'pickup')">
                    <x-checkout-input label="Recoger en el local" action="{{ $delivery === 'pickup' ? true : false }}"
                        nameInput="pickup" idInput="delivery">
                        @if (isset($company_address->address))
                            <p>Puede recoger su pedido en: {{ $company_address->address }}</p>
                        @else
                            <p>Puede recoger su pedido en la sucursal</p>
                        @endif
                    </x-checkout-input>
                </div>
                <!--Delivery-->
                <div wire:click="$set('delivery', 'delivery')">
                    <x-checkout-input label="Envío a domicilio" action="{{ $delivery === 'delivery' ? true : false }}"
                        nameInput="delivery" idInput="delivery">
                        <!--Has address-->
                        @if ($address)
                            <div class="w-full flex flex-col gap-3">
                                <h1 class="text-md ">Enviar a:</h1>
                                <span class="font-thin">{{ $address->address }},
                                    {{ $address->reference }}</span>
                                <div>
                                    <a href="{{ route('customer.addresses') }}">
                                        <x-customer-button variant="secondary" size="small">Cambiar
                                            dirección</x-customer-button>
                                    </a>
                                </div>
                            </div>
                        @else
                            <!--Not has address-->
                            <div class="mb-4">
                                <x-input class="w-full" placeholder="Dirección de calle"
                                    wire:model.blur="checkoutAddress.street"></x-input>
                                <x-inputs.error for="checkoutAddress.street" />
                            </div>
                            <div class="mb-4">
                                <x-input class="w-full" placeholder="Referencia"
                                    wire:model.blur="checkoutAddress.reference"></x-input>
                                <x-inputs.error for="checkoutAddress.reference" />
                            </div>
                        @endif
                    </x-checkout-input>
                </div>
                <div class="py-3 mx-3 border-t border-brown-primary border-opacity-20">
                    <h4>Preferencia de entrega:</h4>
                    <div class="w-full flex gap-3 mt-2">
                        <div class="w-full">
                            <x-input type="date" class="!w-full" wire:model="delivery_date" />
                            <x-inputs.error for="delivery_date" />
                        </div>
                        <div class="w-full">
                            <x-customer-select class="!w-full" :disabled="$delivery ? false : true" wire:model="delivery_time">
                                <option value="">Seleccione una hora</option>
                                @if ($delivery == 'pickup')
                                    @foreach ($times as $time)
                                        <option value="{{ $time->id }}">
                                            {{ Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('H:i') }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($times_free as $time)
                                        <option value="{{ $time->id }}">
                                            {{ Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('H:i') }}
                                        </option>
                                    @endforeach
                                @endif
                            </x-customer-select>
                            <x-inputs.error for="delivery_time" />
                        </div>

                    </div>
                    <x-inputs.error for="delivery_date_time" />
                </div>
            </x-checkout-section>
            <x-inputs.error for="delivery" class="p-2" />
            <x-checkout-section title="Información adicional">
                <div class=" p-3 flex flex-col gap-2">
                    <span>Notas del pedido (opcional)</span>
                    <x-customer-textarea placeholder="por ejemplo, notas especiales para la entrega"
                        wire:model.blur="description"></x-customer-textarea>
                </div>
            </x-checkout-section>
        </div>
    </div>
    <div class="w-full">
        <!--Order information-->
        <div class="bg-white border border-border rounded px-5 pb-5">
            <!--Products in cart-->
            <x-checkout-section title="Su pedido">
                @foreach ($cart['products'] as $product)
                    <div class="flex justify-between text-md py-1 px-5">
                        <h5 class="uppercase">{{ $product['name'] }}
                            <span class="lowercase">x</span>
                            {{ $product['quantity'] }}
                        </h5>
                        <h6>Bs{{ $product['subtotal'] }}</h6>
                    </div>
                @endforeach
                <div class=" flex justify-between text-lg py-1 mx-5 border-t border-brown-primary border-opacity-20">
                    <h5>Total</h5>
                    <h6>Bs{{ $total }}</h6>
                </div>
            </x-checkout-section>
            <!--Order input-->
            <div>
                <x-customer-button size="large" wire:click="store" class="mt-5 w-full h-[72px]">
                    REALIZAR PEDIDO
                </x-customer-button>
            </div>
        </div>
    </div>
</div>
