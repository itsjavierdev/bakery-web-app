@props(['product'])

<a href="{{ route('show-product', $product->slug) }}">
    <div class="h-full">
        <div
            class="bg-white w-60 rounded-md p-3 shadow-card transition-transform duration-400 ease-in-out transform hover:translate-y-[-1%] hover:shadow-card-hover cursor-pointer max-w-250px h-full">
            <img width="240" class="rounded" src="{{ asset('storage/products/240/' . $product->first_image) }}"
                alt="producto-{{ $product->name }}">
            <div class=" flex flex-col justify-between items-center pt-2 gap-2">
                <div>
                    <h5 class="text-lg text-center uppercase">{{ $product->name }}</h5>
                </div>

                <h5>Bs
                    {{ number_format($product->total_price, $product->total_price != floor($product->total_price) ? 1 : 0) }}
                </h5>
                {{ $slot }}

            </div>
        </div>
    </div>
</a>
