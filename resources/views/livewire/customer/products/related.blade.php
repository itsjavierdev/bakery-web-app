<div class="bg-yellow-secondary">

    @if (!$related_products->isEmpty())
        <div class="max-w-6xl mx-auto justify-center py-10 ">
            <!--Best Sellers Products-->
            <div class="w-full flex flex-col gap-5">
                <x-title txtsize="2xl">Productos relacionados</x-title>
                <div class="flex justify-center flex-wrap gap-10">
                    <!--Products-->
                    @foreach ($related_products as $group)
                        <div class="flex flex-wrap sm:flex-nowrap justify-center gap-10">
                            @foreach ($group as $product)
                                <div class="w-1/2">

                                    <x-product-card :product="$product">
                                        <x-customer-button size="medium" class="!w-full"
                                            wire:click.prevent="$dispatch('addToCart', {product_id:{{ $product->id }}})">
                                            agregar al carrito
                                        </x-customer-button>
                                    </x-product-card>

                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
