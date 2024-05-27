<div
    class="fixed md:relative md:bottom-0 md:right-0 bottom-10 right-10 w-16 h-16 md:w-0 md:h-0 flex justify-center items-center rounded-full bg-brown-primary border border-gray-50">
    <a href="{{ route('cart') }}" class="relative">
        <i class="icon-cart md:text-2xl text-4xl hover:text-yellow-primary"></i>
        @if (count($cart['products']) > 0)
            <span
                class="absolute md:bottom-3 md:left-4 bottom-5 left-5 bg-white text-brown-primary border border-brown-primary w-6 h-6 md:w-5 md:h-5 flex text-xs items-center justify-center rounded-full">
                {{ $total_quantity }}
            </span>
        @endif
    </a>
</div>
