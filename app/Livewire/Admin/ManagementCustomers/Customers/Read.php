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
        return Customer::query()
            ->select('customers.*', 'verified', DB::raw('CONCAT_WS(" ", NULLIF(name, ""), NULLIF(surname, "")) AS full_name'))
            ->leftJoin('customer_accounts', 'customers.id', '=', 'customer_accounts.customer_id')
            ->whereNotNull('phone')
            ->where('phone', '!=', '')
            ->where(function ($query) {

                $query->whereNull('customer_accounts.customer_id')
                    ->orWhereNotNull('customer_accounts.email_verified_at');
            })
            ->orderBy('verified', 'asc');
    }

    public function columns(): array
    {
        return [
            Column::make('customers.id', 'ID')->isDefault(),
            Column::make('full_name', 'Nombre completo')->isDefault(),
            Column::make('phone', 'Telefono')->isDefault(),
            Column::make('email', 'Correo electronico')->isDefault(),
            Column::make('verified', 'Verificado')->isDefault()->component('admin.atoms.table.columns.boolean'),
            Column::make('customers.created_at', 'Fecha de registro')->isDefault(),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('customers.id', 'ID'),
            Filter::make('name', 'Nombre'),
            Filter::make('surname', 'Apellido'),
            Filter::make('phone', 'Telefono'),
            Filter::make('customers.created_at', 'Fecha de registro')->date(),
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
