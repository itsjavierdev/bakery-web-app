<?php

namespace App\Livewire\DeliveryTimes;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use App\Views\Table\Filter;
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
            Column::make('time', 'Hora')->isDefault()->component('columns.time'),
            Column::make('available', 'Disponible')->isDefault()->component('columns.boolean'),
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
        return 'horarios';
    }
}
