<?php

namespace App\Livewire\Admin\ManagementAdmin\Roles;

use App\Livewire\Others\Datatable;
use App\View\Table\Column;
use App\View\Table\Filter;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class Read extends Datatable
{

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        $user = Auth::user();

        return Role::query()->where('id', '!=', 1);
        //return Role::query()->where('id', '!=', 1)->where('id', '!=', $user->roles->first()->id);
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
