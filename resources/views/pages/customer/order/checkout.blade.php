<x-customer>
    @push('pageTitle', 'Realizar pedido')
    <div class="">
        <div class="px-4 md:px-0">
            <!--TITLE-->
            <x-title class="mb-10 pt-10">Realizar pedido</x-title>
            <!--FORM-->
            <div>
                <livewire:customer.order.checkout />
            </div>
        </div>
    </div>
</x-customer>
