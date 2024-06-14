<?php

namespace App\Livewire\Admin\ManagementCustomers\Customers;


use App\Livewire\Others\Datatable;
use App\View\Table\Column;
use App\View\Table\Filter;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class Read extends Datatable
{

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Customer::query()->select('*', 'verified', DB::raw('CONCAT_WS(" ", NULLIF(name, ""), NULLIF(surname, "")) AS full_name'))->orderBy('verified', 'asc');
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('full_name', 'Nombre completo')->isDefault(),
            Column::make('phone', 'Telefono')->isDefault(),
            Column::make('email', 'Correo electronico')->isDefault(),
            Column::make('verified', 'Verificado')->isDefault()->component('admin.atoms.table.columns.boolean'),
            Column::make('created_at', 'Fecha de registro')->isDefault(),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('id', 'ID'),
            Filter::make('name', 'Nombre'),
            Filter::make('surname', 'Apellido'),
            Filter::make('phone', 'Telefono'),
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
        return 'customers';
    }
}
