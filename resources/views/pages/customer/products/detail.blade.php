<x-customer class="!max-w-full !py-0 !" register_bg="bg-yellow-primary">
    @push('pageTitle', $product->name)

    <livewire:customer.products.detail product_id="{{ $product->id }}" />
    <livewire:customer.products.related product_id="{{ $product->id }}" />
    <livewire:customer.cart.add-cart />
</x-customer>
