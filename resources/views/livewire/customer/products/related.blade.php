<div class="bg-yellow-secondary">

    @if (!$related_products->isEmpty())
        <div class="max-w-6xl mx-auto justify-center py-10 ">
            <!--Best Sellers Products-->
            <div class="w-full flex flex-col gap-5">
                <x-title txtsize="2xl">Productos relacionados</x-title>
                <div class="flex justify-center flex-wrap gap-5">
                    <!--Products-->
                    @foreach ($related_products as $product)
                        <x-product-card :product="$product">
                            <x-customer-button size="small" class="!w-full"
                                wire:click.prevent="$dispatch('addToCart', {product_id:{{ $product->id }}})">
                                agregar
                            </x-customer-button>
                        </x-product-card>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
