<div class="w-full lg:w-1/2 px-2.5 mb-5">
    <div class="w-full h-full bg-gray-100 rounded-lg shadow p-5 pb-0 mb-5">
        <!--Last year-->
        <div class="{{ $chart_sales == 'year' ? '' : 'hidden' }}">
            <livewire:admin.dashboard.sales.last-year>
        </div>
        <!--Last month-->
        <div class="{{ $chart_sales == 'month' ? '' : 'hidden' }}">
            <livewire:admin.dashboard.sales.last-month>
        </div>
        <!--Last week-->
        <div class="{{ $chart_sales == 'week' ? '' : 'hidden' }}">
            <livewire:admin.dashboard.sales.last-week>
        </div>
        <div class="pt-5 flex flex-wrap">
            <!--Last year button-->
            @if ($chart_sales == 'year')
                <div class="w-1/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-button class="text-[11px] mb-2 w-full justify-center "
                        wire:click="$set('chart_sales', 'year' )">ULTIMO
                        AÑO</x-button>
                </div>
            @else
                <div class="w-1/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-secondary-button class="text-[11px] mb-2 w-full justify-center "
                        wire:click="$set('chart_sales', 'year' )">ULTIMO
                        AÑO</x-secondary-button>
                </div>
            @endif
            <!--Last month button-->
            @if ($chart_sales == 'month')
                <div class="w-1/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-button class="text-[11px] mb-2 w-full justify-center "
                        wire:click="$set('chart_sales', 'month' )">ULTIMO
                        MES</x-button>
                </div>
            @else
                <div class="w-1/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-secondary-button class="text-[11px] mb-2 w-full justify-center "
                        wire:click="$set('chart_sales', 'month' )">ULTIMO
                        MES</x-secondary-button>
                </div>
            @endif
            <!--Last week button-->
            @if ($chart_sales == 'week')
                <div class="w-1/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-button class="text-[11px] mb-2 w-full justify-center "
                        wire:click="$set('chart_sales', 'week' )">ULTIMA
                        SEMANA</x-button>
                </div>
            @else
                <div class="w-1/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 px-1">
                    <x-secondary-button class="text-[11px] mb-2 w-full justify-center "
                        wire:click="$set('chart_sales', 'week' )">ULTIMA
                        SEMANA</x-secondary-button>
                </div>
            @endif

        </div>
    </div>
</div>
