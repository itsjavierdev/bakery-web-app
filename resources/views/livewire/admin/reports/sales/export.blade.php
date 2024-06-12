<x-form-template>
    <div>

        <div class="">
            <!--Report by-->
            <x-inputs.group class="w-full  col-span-2 lg:col-span-1">
                <x-inputs.label value="Reporte de" />
                <x-inputs.select wire:model.change="report_by">
                    <option value="resume">Resumen</option>
                    <option value="all-sales">Todas las Ventas</option>
                    <option value="by-products">Ventas por Productos</option>
                    <option value="by-categories">Ventas por Categorías</option>
                    <option value="by-staff">Ventas por Personal</option>
                    <option value="by-single-staff">Ventas de un Personal</option>
                    <option value="by-customers">Ventas por Cliente</option>
                </x-inputs.select>
            </x-inputs.group>

            @if ($report_by == 'by-single-staff')
                <x-inputs.group>
                    <!--Select Customer or add a name-->
                    <x-inputs.label value="Personal" is_required />
                    <div class="flex gap-2">
                        <x-inputs.text wire:model="staff.name" disabled />
                        <div>
                            <x-secondary-button wire:click="toggleModal('staff')" tabindex="-1"><i
                                    class="icon-bars text-2xl"></i></x-secondary-button>
                        </div>
                    </div>
                    <x-inputs.error for="staff.name" />
                </x-inputs.group>
            @endif



            <!--Period-->
            <x-inputs.group class="w-full   col-span-2 lg:col-span-1">
                <x-inputs.label value="Periodo" />
                <x-inputs.select wire:model.change="period">
                    @if ($report_by == 'resume')
                        <option value="daily">Diario</option>
                        <option value="monthly">Mensual</option>
                        <option value="annual">Anual</option>
                    @else
                        <option value="byMonth">Por mes</option>
                        <option value="byMonths">Entre meses</option>
                        <option value="byDate">Por fecha</option>
                        <option value="byDates">Entre fechas</option>
                    @endif
                </x-inputs.select>
            </x-inputs.group>
            @if ($report_by == 'resume' && $period == 'annual')
                {{ '' }}
            @else
                <!--Start Date-->
                <x-inputs.group class="w-full  ">
                    <x-inputs.label
                        value="{{ ($period == 'byMonth' ? 'Mes:' : $period == 'byDate') ? 'Fecha:' : 'Desde:' }}"
                        is_required />
                    <x-inputs.date type="{{ $input_type }}" wire:model.change="start_date" />
                    <x-inputs.error for="start_date" />
                </x-inputs.group>
                @if ($period == 'byMonths' || $period == 'byDates' || $report_by == 'resume')
                    <!--End Date-->
                    <x-inputs.group class="w-full  ">
                        <x-inputs.label value="Hasta:" is_required />
                        <x-inputs.date type="{{ $input_type }}" wire:model.change="end_date" />
                        <x-inputs.error for="end_date" />
                    </x-inputs.group>
                @endif
            @endif

        </div>
    </div>
    <x-dialog-modal wire:model=open>
        <x-slot name="title">
            <h2 class="text-lg font-semibold">Seleccionar personal</h2>
        </x-slot>
        <x-slot name=content>
            <livewire:admin.management-admin.staff.all add />
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end w-full">
                <x-secondary-button wire:click="toggleModal('')">Cancelar</x-secondary-button>
            </div>
        </x-slot>
    </x-dialog-modal>
    <x-slot name="footer">
        <x-button color="red" wire:click="exportPDF">Exportar PDF</x-button>
        <x-button color="green" wire:click="exportExcel">Exportar Excel</x-button>
    </x-slot>
</x-form-template>
