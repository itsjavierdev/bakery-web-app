<x-admin-header title="Panel">
    @can('sales_report.trigger')
        <div class="p-6">
            <livewire:admin.dashboard.summary />
            <hr />
            <div class="flex flex-wrap justify-center mt-5 -mx-2.5">
                <livewire:admin.dashboard.products.index />
                <livewire:admin.dashboard.sales.index />
            </div>
        </div>
    @else
        <!--No access to sales report-->
        <div class="flex flex-col items-center justify-center h-full flex-grow">
            <h2 class="text-2xl text">
            </h2>
        </div>
    @endcan
</x-admin-header>
