<div>
    @if (!$best_sellers_products->isEmpty())
        <div class="max-w-6xl mx-auto justify-center py-10">
            <!--Best Sellers Products-->
            <div class="w-full flex flex-col gap-5">
                <x-title txtsize="2xl">MÁS VENDIDOS</x-title>
                <div class="flex justify-center flex-wrap gap-10">
                    <!--Products-->
                    @foreach ($best_sellers_products as $group)
                        <div class="flex flex-wrap sm:flex-nowrap justify-center gap-10">
                            @foreach ($group as $product)
                                <div class="w-1/2">
                                    <a href="">
                                        <x-product-card :product="$product">
                                            <x-customer-button size="medium" class="!w-full">
                                                agregar al carrito
                                            </x-customer-button>
                                        </x-product-card>
                                    </a>
                                </div>
                            @endforeach
                        </div>
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
                <div class="flex justify-center flex-wrap gap-10">
                    <!--Products-->
                    @foreach ($recent_products as $group)
                        <div class="flex flex-wrap sm:flex-nowrap justify-center gap-10">
                            @foreach ($group as $product)
                                <div class="w-1/2">
                                    <a href="">
                                        <x-product-card :product="$product">
                                            <x-customer-button size="medium" class="!w-full">
                                                agregar al carrito
                                            </x-customer-button>
                                        </x-product-card>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
