@props(['product'])

<a href="{{ route('show-product', $product->slug) }}">
    <div class="h-full ">
        <div
            class="bg-white w-60 rounded-md p-3 shadow-card transition-transform cursor-pointer max-w-250px h-full flex flex-col justify-between gap-3 group">
            <div>
                <div class="w-54 h-54 overflow-hidden">
                    <img width="240" class="rounded group-hover:scale-110 duration-500"
                        src="{{ asset('storage/products/240/' . $product->first_image) }}"
                        alt="producto-{{ $product->name }}">
                </div>
                <div class=" flex flex-col justify-between pt-2 gap-2">
                    <div>
                        <h5 class="text-base font-medium">{{ $product->name }}</h5>
                        @if ($product->bag_quantity > 1)
                            <span class="text-gray-500 text-sm">{{ $product->bag_quantity }} unidades</span>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <hr class="mb-3">
                <div class="flex gap-3 items-center">
                    <h5 class="font-semibold w-full">Bs
                        {{ number_format($product->price_by_bag, $product->price_by_bag != floor($product->price_by_bag) ? 1 : 0) }}
                    </h5>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</a>

@push('links')
    <style>
        .hover-zoom {
            transition: transform 0.3s ease-in-out;
        }

        .hover-zoom:hover {
            transform: scale(1.1);
        }
    </style>
@endpush
