<div class="flex flex-wrap justify-center -mx-2">
    <x-summary-card title="Pedidos" class="bg-red-500">
        <x-slot name="icon">
            <i class="icon-order"></i>
        </x-slot>
        {{ $totalOrders }}
    </x-summary-card>
    <x-summary-card title="Ingresos del día" class="bg-green-500">
        <x-slot name="icon">
            <i class="icon-money-mark"></i>
        </x-slot>
        Bs {{ $totalIncomeToday }}
    </x-summary-card>
    <x-summary-card title="Ingresos de ayer" class="bg-green-700">
        <x-slot name="icon">
            <i class="icon-money-mark-yesterday"></i>
        </x-slot>
        Bs {{ $totalIncomeYesterday }}
    </x-summary-card>
    <x-summary-card title="Productos vendidos" class="bg-blue-500">
        <x-slot name="icon">
            <i class="icon-cart"></i>
        </x-slot>
        {{ $totalProductsSoldToday }}
    </x-summary-card>
    <x-summary-card title="Productos vendidos ayer" class="bg-blue-700">
        <x-slot name="icon">
            <i class="icon-cart-yesterday"></i>
        </x-slot>
        {{ $totalProductsSoldYesterday }}
    </x-summary-card>
    <x-summary-card title="Ventas del día" class="bg-violet-500">
        <x-slot name="icon">
            <i class="icon-chart"></i>
        </x-slot>
        {{ $totalSalesToday }}
    </x-summary-card>
    <x-summary-card title="Ventas de ayer" class="bg-violet-700">
        <x-slot name="icon">
            <i class="icon-chart-yesterday"></i>
        </x-slot>
        {{ $totalSalesYesterday }}
    </x-summary-card>
    <x-summary-card title="Clientes" class="bg-orange-500">
        <x-slot name="icon">
            <i class="icon-user"></i>
        </x-slot>
        {{ $totalCustomers }}
    </x-summary-card>
</div>
