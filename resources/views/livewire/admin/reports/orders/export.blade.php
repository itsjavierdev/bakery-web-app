<x-form-template>
    <!--Report by-->
    <x-inputs.group class="w-full  col-span-2 lg:col-span-1">
        <x-inputs.label value="Reporte de" />
        <x-inputs.select wire:model.change="report_by">
            <option value="all-orders">Pedidos por entregar</option>
            <option value="expired-orders">Pedidos vencidos</option>
            <option value="products">Productos por entregar</option>
            <option value="by-time">Pedidos por horarios de entrega</option>
        </x-inputs.select>
    </x-inputs.group>
    <!--Period-->
    <x-inputs.group class="w-full   col-span-2 lg:col-span-1">
        <x-inputs.label value="Periodo" />
        <x-inputs.select wire:model.change="period">
            <option value="byDate">Por fecha</option>
            <option value="byDates">Entre fechas</option>
        </x-inputs.select>
    </x-inputs.group>
    <!--Start Date-->
    <x-inputs.group class="w-full  ">
        <x-inputs.label value="{{ $period == 'byDate' ? 'Día:' : 'Desde:' }}" />
        <x-inputs.date type="date" wire:model.change="start_date" />
        <x-inputs.error for="start_date" />
    </x-inputs.group>
    @if ($period == 'byMonths' || $period == 'byDates' || $report_by == 'resume')
        <!--End Date-->
        <x-inputs.group class="w-full  ">
            <x-inputs.label value="Hasta:" />
            <x-inputs.date type="date" wire:model.change="end_date" />
            <x-inputs.error for="end_date" />
        </x-inputs.group>
    @endif

    <x-slot name="footer">
        <x-button color="red" wire:click="exportPDF">Exportar PDF</x-button>
        <x-button color="green" wire:click="exportExcel">Exportar Excel</x-button>
    </x-slot>
</x-form-template>
