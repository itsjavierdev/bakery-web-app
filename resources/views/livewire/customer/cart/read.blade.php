<div>
    @if (count($cart['products']) > 0)

        <div class="md:flex justify-center gap-6 mt-9 pb-48 ">
            <!--PRODUCTS-->
            <div class="basis-2/3 rounded">
                <div class="h-fit rounded-t-lg md:rounded-lg  overflow-hidden">
                    @foreach ($cart['products'] as $product)
                        <div class="flex items-center py-5 h-32 odd:bg-white even:bg-yellow-secondary px-3">
                            <div class="basis-1/6  mr-3">
                                <img width="90px" height="90px" class="rounded-md"
                                    src="{{ asset('storage/products/128/' . $product['first_image']) }}" alt="">
                            </div>
                            <div class="basis-3/6">
                                <h1 class="text-lg  uppercase">{{ $product['name'] }}</h1>
                                <span class="font-thin">Bs{{ $product['subtotal_price'] }}</span>
                            </div>
                            <div class="basis-2/6 flex justify-around items-center gap-2">
                                <form wire:submit.prevent="updateQuantity({{ $product['id'] }})"
                                    class="flex gap-3 items-center ">
                                    <x-input-quantity type="number" wire:model.defer="quantities.{{ $product['id'] }}"
                                        min="1" />
                                    <span>Bs {{ $product['subtotal'] }}</span>
                                    <button type="submit"
                                        class="border-2 flex justify-center items-center rounded-full min-w-9 min-h-9 border-brown-primary text-brown-primary text-lg"><i
                                            class="icon-spin"></i></button>
                                </form>
                                <button
                                    class="border-2 flex justify-center items-center rounded-full min-w-9 min-h-9 border-brown-primary text-brown-primary text-lg"
                                    wire:click="removeFromCart({{ $product['id'] }})">
                                    <i class="icon-trash "></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--CHECKOUT-->
            <div class="basis-1/3">
                <div class="bg-white rounded-b-lg md:rounded-lg  pt-6 px-4 pb-2 flex flex-col gap-4 ">
                    <div class="text-xl flex justify-between">
                        <h1>Subtotal</h1>
                        <h1>Bs {{ $total }}</h1>
                    </div>
                    <a href="{{ route('customer.checkout') }}" class="w-full">
                        <x-customer-button size="large" class="w-full">
                            <span class=" text-lg text-white">COMPRAR</span>
                        </x-customer-button>
                    </a>
                    <a href="{{ route('customer.shop') }}"
                        class="text-center text-md sm:text-base md:text-xs lg:text-base hover:text-blue-800">CONTINUAR
                        COMPRANDO</a>
                </div>
            </div>
        </div>
    @else
        <!--CART EMPTY-->
        <div class="md:flex justify-center gap-6 mt-32 pb-48 text-xl mb-20">
            <p class="text-center">Tu carrito está vacio, hoy es un buen día para
                <a href="{{ route('customer.shop') }}" class="underline hover:text-blue-700"> empezar a comprar.</a>
            </p>
        </div>
    @endif
</div>
