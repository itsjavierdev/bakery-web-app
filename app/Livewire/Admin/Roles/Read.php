<?php

namespace App\Livewire\Admin\Roles;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use App\Views\Table\Filter;
use Spatie\Permission\Models\Role;


class Read extends Datatable
{

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Role::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('name', 'Nombre')->isDefault(),
            Column::make('created_at', 'Fecha de registro'),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('id', 'ID'),
            Filter::make('name', 'Nombre'),
            Filter::make('created_at', 'Fecha de registro')->date(),
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
        return 'roles';
    }
}
