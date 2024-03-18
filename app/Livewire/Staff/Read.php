<?php

namespace App\Livewire\Staff;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use App\Models\Staff;

class Read extends Datatable
{
    protected $listeners = ['render'];

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Staff::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID'),
            Column::make('name', 'Nombre'),
            Column::make('surname', 'Apellido'),
            Column::make('phone', 'Telefono'),
            Column::make('CI', 'CI'),
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
        return 'personal';
    }

}
