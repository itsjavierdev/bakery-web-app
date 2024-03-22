<?php

namespace App\Livewire\Staff;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Read extends Datatable
{
    protected $listeners = ['render'];

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        //get authenticated user to show all staff except the authenticated user
        $user = Auth::user();
        // Union of staff and users table to get the email and role of the user
        return Staff::leftJoin('users', 'staff.id', '=', 'users.staff_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('staff.id', 'is_employed', 'users.email AS email', 'roles.name AS role', DB::raw('CONCAT(staff.name, " ", staff.surname) AS full_name'))
            ->where('staff.id', '!=', $user->staff_id);

    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID'),
            Column::make('full_name', 'Nombre completo'),
            Column::make('email', 'Email'),
            Column::make('role', 'Rol'),
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
