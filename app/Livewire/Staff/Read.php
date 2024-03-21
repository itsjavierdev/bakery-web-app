<?php

namespace App\Livewire\Staff;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class Read extends Datatable
{
    protected $listeners = ['render'];

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        $user = Auth::user();

        // Obtener los registros de staff que no están asociados con el usuario autenticado
        return Staff::where('id', '!=', $user->staff_id);

    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID'),
            Column::make('name', 'Nombre'),
            Column::make('surname', 'Apellido'),
            Column::make('phone', 'Telefono'),
            Column::make('CI', 'CI'),
            Column::make('is_employed', 'Empleado')->component('columns.boolean'),
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
