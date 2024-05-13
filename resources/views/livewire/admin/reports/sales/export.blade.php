<x-form-template>
    <div>
        @php
            $input_type = $period == 'byMonth' || $period == 'byMonths' ? 'month' : 'date';
        @endphp
        <div class="">
            <!--Period-->
            <x-inputs.group class="w-full   col-span-2 lg:col-span-1">
                <x-inputs.label value="Periodo" />
                <x-inputs.select wire:model.change="period">
                    <option value="byMonth">Por mes</option>
                    <option value="byMonths">Entre meses</option>
                    <option value="byDate">Por fecha</option>
                    <option value="byDates">Entre fechas</option>
                </x-inputs.select>
            </x-inputs.group>
            <!--Start Date-->
            <x-inputs.group class="w-full  ">
                <x-inputs.label
                    value="{{ ($period == 'byMonth' ? 'Mes:' : $period == 'byDate') ? 'Fecha:' : 'Desde:' }}" />
                <x-inputs.date type="{{ $input_type }}" wire:model.change="start_date" />
                <x-inputs.error for="start_date" />
            </x-inputs.group>
            @if ($period == 'byMonths' || $period == 'byDates')
                <!--End Date-->
                <x-inputs.group class="w-full  ">
                    <x-inputs.label value="Hasta:" />
                    <x-inputs.date type="{{ $input_type }}" wire:model.change="end_date" />
                    <x-inputs.error for="end_date" />
                </x-inputs.group>
            @endif
            <!--Period-->
            <x-inputs.group class="w-full  col-span-2 lg:col-span-1">
                <x-inputs.label value="Agrupar por" />
                <x-inputs.select wire:model.change="report_by">
                    <option value="all-sales">Todas las Ventas</option>
                    <option value="by-products">Ventas por Productos</option>
                    <option value="by-categories">Ventas por Categorías</option>
                    <option value="by-staff">Ventas por Personal</option>
                    <option value="by-customers">Ventas por Cliente</option>
                </x-inputs.select>
            </x-inputs.group>
        </div>
        <div>
            <div>

            </div>
        </div>
    </div>
    <x-slot name="footer">
        <x-button color="red" wire:click="exportPDF">Exportar PDF</x-button>
        <x-button color="green" wire:click="exportExcel">Exportar Excel</x-button>
    </x-slot>
</x-form-template>
