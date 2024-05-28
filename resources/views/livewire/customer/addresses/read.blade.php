<div class="p-4">
    <div class="md:flex justify-between items-center {{ $previous ? 'md:flex-row-reverse' : '' }}">
        <!--if you accessed the addresses from checkout -->
        @if ($previous)
            <a href="{{ route('customer.checkout') }}" class="underline p-5">Volver a Checkout
            </a>
        @endif
        <div class="flex gap-4 py-3 items-center">
            <livewire:customer.addresses.form />
        </div>
    </div>
    <div class="flex flex-wrap -mx-2">
        @foreach ($addresses as $address)
            <x-address-card :address="$address"></x-address-card>
        @endforeach
    </div>
</div>
