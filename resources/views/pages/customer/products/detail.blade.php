<x-customer class="!max-w-full !py-0 !">
    @push('pageTitle', $product->name)

    <livewire:customer.products.detail product_id="{{ $product->id }}" />
    <livewire:customer.products.related product_id="{{ $product->id }}" />
    <livewire:customer.cart.add-cart />
</x-customer>
