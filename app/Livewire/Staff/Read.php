<?php

namespace App\Livewire\Staff;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use App\Views\Table\Filter;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Read extends Datatable
{

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        //get authenticated user to show all staff except the authenticated user
        $user = Auth::user();
        // Union of staff and users table to get the email and role of the user
        return Staff::leftJoin('users', 'staff.id', '=', 'users.staff_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('staff.*', 'is_employed', 'users.email AS email', 'roles.name AS role', DB::raw('CONCAT(staff.name, " ", staff.surname) AS full_name'))
            ->where('staff.id', '!=', $user->staff_id);

    }
    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('created_at', 'Fecha de registro'),
            Column::make('full_name', 'Nombre completo')->isDefault(),
            Column::make('email', 'Email')->isDefault(),
            Column::make('role', 'Rol')->isDefault(),
            Column::make('phone', 'Telefono'),
            Column::make('CI', 'Carnet'),
            Column::make('birthdate', 'Fecha de nacimiento'),
            Column::make('is_employed', 'Empleado')->component('columns.boolean'),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('staff.id', 'ID'),
            Filter::make('staff.name', 'Nombre'),
            Filter::make('surname', 'Apellido'),
            Filter::make('email', 'Email'),
            Filter::make('phone', 'Telefono'),
            Filter::make('roles.name', 'Rol'),
            Filter::make('CI', 'Carnet'),
            Filter::make('birthdate', 'Fecha de nacimiento'),
            Filter::make('staff.created_at', 'Fecha de registro'),
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
