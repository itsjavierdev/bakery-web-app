<?php

namespace App\Livewire\Roles;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use Spatie\Permission\Models\Role;


class Read extends Datatable
{
    protected $listeners = ['render'];

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Role::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID'),
            Column::make('name', 'Nombre'),
        ];
    }

    public function actions(): array
    {
        return [
            'update',
            'delete'
        ];
    }

    public function routesPrefix(): string
    {
        return 'roles';
    }
}
