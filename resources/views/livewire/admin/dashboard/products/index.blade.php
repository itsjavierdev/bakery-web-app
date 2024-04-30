<div class="w-full lg:w-1/2 px-2.5 mb-5">
    <div class="w-full h-full bg-gray-100 rounded-lg shadow p-5 pb-0 mb-5">
        <!--Best sellers-->
        <div class="{{ $chart_product == 'sellingDesc' ? '' : 'hidden' }}">
            <livewire:admin.dashboard.products.most-popular>
        </div>
        <!--Least sellers-->
        <div {{ $chart_product == 'sellingAsc' ? '' : 'hidden' }}>
            <livewire:admin.dashboard.products.less-popular>
        </div>
        <!--High revenue-->
        <div {{ $chart_product == 'revenueDesc' ? '' : 'hidden' }}>
            <livewire:admin.dashboard.products.high-revenue>
        </div>
        <!--Low revenue-->
        <div {{ $chart_product == 'revenueAsc' ? '' : 'hidden' }}>
            <livewire:admin.dashboard.products.low-revenue>
        </div>
        <div class="pt-5 flex flex-wrap">
            <!--Best sellers button-->
            @if ($chart_product == 'sellingDesc')
                <div class="w-1/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-button class="text-[11px] mb-2 w-full justify-center"
                        wire:click="$set('chart_product', 'sellingDesc')">Mas
                        vendidos</x-button>
                </div>
            @else
                <div class="w-1/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-secondary-button class="text-[11px] mb-2 w-full justify-center"
                        wire:click="$set('chart_product', 'sellingDesc')">Mas
                        vendidos</x-secondary-button>
                </div>
            @endif
            <!--Least seller button-->
            @if ($chart_product == 'sellingAsc')
                <div class="w-1/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-button class="text-[11px] mb-2 w-full justify-center"
                        wire:click="$set('chart_product', 'sellingAsc')">Menos
                        vendidos</x-button>
                </div>
            @else
                <div class="w-1/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-secondary-button class="text-[11px] mb-2 w-full justify-center"
                        wire:click="$set('chart_product', 'sellingAsc')">Menos
                        vendidos</x-secondary-button>
                </div>
            @endif
            <!--High revenue button-->
            @if ($chart_product == 'revenueDesc')
                <div class="w-1/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-button class="text-[11px] mb-2 w-full justify-center"
                        wire:click="$set('chart_product', 'revenueDesc')">Mas
                        ingresos</x-button>
                </div>
            @else
                <div class="w-1/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-secondary-button class="text-[11px] mb-2 w-full justify-center"
                        wire:click="$set('chart_product', 'revenueDesc')">Mas
                        ingresos</x-secondary-button>
                </div>
            @endif
            <!--Low revenue button-->
            @if ($chart_product == 'revenueAsc')
                <div class="w-1/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-button class="text-[11px] mb-2 w-full justify-center"
                        wire:click="$set('chart_product', 'revenueAsc')">Menos
                        ingresos</x-button>
                </div>
            @else
                <div class="w-1/4 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-secondary-button class="text-[11px] mb-2 w-full justify-center"
                        wire:click="$set('chart_product', 'revenueAsc')">Menos
                        ingresos</x-secondary-button>
                </div>
            @endif
        </div>
    </div>
</div>
