<x-admin-header title="Panel">
    <div class="p-6">
        <livewire:admin.dashboard.summary />
        <hr />
        <div class="flex flex-wrap justify-center mt-5 -mx-2.5">
            <livewire:admin.dashboard.products.index />
            <livewire:admin.dashboard.sales.index />
        </div>
    </div>
</x-admin-header>
