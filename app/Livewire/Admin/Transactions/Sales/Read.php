<?php

namespace App\Livewire\Admin\Transactions\Sales;

use App\Livewire\Others\Datatable;
use App\View\Table\Column;
use App\View\Table\Filter;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class Read extends Datatable
{
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Sale::query()->leftJoin('staff', 'sales.staff_id', '=', 'staff.id')
            ->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
            ->select(
                'sales.id AS id',
                'sales.created_at AS created_at',
                'sales.total AS total',
                'sales.paid AS paid',
                'sales.paid_amount AS paid_amount',
                DB::raw('CONCAT_WS(" ", NULLIF(staff.name,""), NULLIF(staff.surname,"")) AS staff'),
                DB::raw('CONCAT_WS(" ", NULLIF(customers.name,""), NULLIF(customers.surname,"")) AS customer'),
                DB::raw('CONCAT(COALESCE(sales.total, 0), " ", COALESCE(sales.paid_amount, 0)) AS paid_info')

            );
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('staff', 'Personal')->isDefault(),
            Column::make('customer', 'Cliente')->isDefault(),
            Column::make('total', 'Total')->isDefault(),
            Column::make('paid_info', 'Deuda')->component('admin.atoms.table.columns.orders.paid-info')->isDefault(),
            Column::make('created_at', 'Fecha de registro')->isDefault(),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('sales.id', 'ID'),
            Filter::make('addresses.address', 'Dirección'),
            Filter::make('customers.name', 'Nombre cliente'),
            Filter::make('customers.surname', 'Apellido cliente'),
            Filter::make('staff.name', 'Nombre cliente'),
            Filter::make('staff.surname', 'Apellido cliente'),
            Filter::make('sales.total', 'Total'),
            Filter::make('sales.paid_amount', 'Total pagado'),
            Filter::make('sales.created_at', 'Fecha de registro')->date(),
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
        return 'sales';
    }
}
