<x-customer class="!max-w-full !py-0 !">
    @push('pageTitle', $product->name)
    <section class=" max-w-4xl flex justify-center mx-auto py-14 ">
        <div class="md:grid grid-cols-2 flex flex-col w-full" style="
        grid-template-columns: 50% 50%;">
            <livewire:customer.products.detail-images product_id="{{ $product->id }}" />
            <!--TITLE-->
            <div class="flex flex-col gap-5 items-center p-5 order-1 md:order-2">
                <x-title txtsize="3xl" class="pt-0">{{ $product->name }}</x-title>
                <span class="text-xl">Bs
                    {{ $product->price * $product->bag_quantity }}</span>
            </div>

            <!--DESCRIPTION-->
            <div class="p-5 flex flex-col gap-5 order-3 md:order-3">
                <p><strong class="font-bold text-md">Incluye:</strong> {{ $product->bag_quantity }} unidades</p>
                <p class="text-start text-pretty">{{ $product->description }}</p>
                <div class="flex gap-2 w-full">
                    <x-input-quantity class="h-[58px]" value="1" />
                    <x-customer-button size="large" class="text-xs w-full h-[58p]">
                        Agregar al carrito
                    </x-customer-button>
                </div>
            </div>
        </div>
    </section>
    <livewire:customer.products.related product_id="{{ $product->id }}" />
</x-customer>
