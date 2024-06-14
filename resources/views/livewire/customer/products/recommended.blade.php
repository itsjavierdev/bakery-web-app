<div>
    @if (!$best_sellers_products->isEmpty())
        <div class="max-w-6xl mx-auto justify-center py-10">
            <!--Best Sellers Products-->
            <div class="w-full flex flex-col gap-5">
                <x-title txtsize="2xl">MÁS VENDIDOS</x-title>
                <div class="flex justify-center flex-wrap gap-5">
                    <!--Products-->
                    @foreach ($best_sellers_products as $product)
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
    <div class="bg-yellow-secondary text-brown-primary">
        <div class="max-w-6xl mx-auto items-center md:justify-center py-7 flex gap-10  flex-col md:flex-row">
            <div class="w-60 flex items-center gap-3">
                <i class="icon-calendar text-3xl"></i>
                <h6>Panaderos desde 2010</h6>
            </div>
            <div class="w-60 flex items-center gap-3">
                <i class="icon-medal text-3xl"></i>
                <h6>Productos de primera calidad</h6>
            </div>
            <div class="w-60 flex items-center gap-3">
                <i class="icon-artisan text-3xl"></i>
                <h6>Elaboración artesanal</h6>
            </div>
        </div>
    </div>
    @if (!$recent_products->isEmpty())
        <div class="max-w-6xl mx-auto justify-center py-7">
            <!--Recent products-->
            <div class="w-full flex flex-col gap-5">
                <x-title txtsize="2xl">NUEVOS</x-title>
                <div class="flex justify-center flex-wrap gap-5">
                    <!--Products-->
                    @foreach ($recent_products as $product)
                        <x-product-card :product="$product">
                            <x-customer-button size="small" class="!w-full"
                                wire:click.prevent="$dispatch('addToCart', {product_id:{{ $product->id }}})">
                                agregar
                            </x-customer-button>
                        </x-product-card>
                    @endforeach
                </div>
            </div>
            <div class="w-full flex justify-center mt-10">
                <a href="{{ route('customer.shop') }}">
                    <x-customer-button variant="secondary" size="small">
                        <span>Ver más<strong class="ms-2"> -</strong></span>
                        <i class="icon-chevron-left"></i>
                    </x-customer-button>
                </a>
            </div>
        </div>


    @endif
    <livewire:customer.cart.add-cart />
</div>
