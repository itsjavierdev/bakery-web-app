<x-customer>
    @push('pageTitle', 'Carrito de compras')
    <div class="">
        <div class="px-4 md:px-0">
            <!--TITLE-->
            <x-title class="mb-10 pt-10">Carrito</x-title>
            <!--FORM-->
            <div>
                <livewire:customer.cart.read />
            </div>
        </div>
    </div>
</x-customer>
