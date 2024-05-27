<?php

namespace App\Livewire\Admin\Parameters\DeliveryTimes;

use App\Livewire\Others\Datatable;
use App\View\Table\Column;
use App\View\Table\Filter;
use App\Models\DeliveryTime;

class Read extends Datatable
{
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return DeliveryTime::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('time', 'Hora')->isDefault()->component('admin.atoms.table.columns.time'),
            Column::make('available', 'Disponible')->isDefault()->component('admin.atoms.table.columns.boolean'),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('id', 'ID'),
            Filter::make('time', 'Hora'),
            Filter::make('available', 'Disponible'),
        ];
    }

    public function actions(): array
    {
        return [
            'detail',
            'update',
            'delete'
        ];
    }

    public function routesPrefix(): string
    {
        return 'deliverytimes';
    }
}
