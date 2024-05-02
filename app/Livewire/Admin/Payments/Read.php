<?php

namespace App\Livewire\Admin\Payments;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use App\Views\Table\Filter;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class Read extends Datatable
{
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Sale::query()->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
            ->leftJoin('payments', 'sales.id', '=', 'payments.sale_id')
            ->select(
                'sales.id AS id',
                'sales.created_at AS created_at',
                'sales.total AS total',
                'sales.paid AS paid',
                'sales.paid_amount AS paid_amount',
                DB::raw('CONCAT_WS(" ", NULLIF(customers.name,""), NULLIF(customers.surname,"")) AS customer'),
                DB::raw('(sales.total - sales.paid_amount) as debt')
            )
            ->where('sales.paid', false);
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('customer', 'Cliente')->isDefault(),
            Column::make('total', 'Total')->isDefault(),
            Column::make('paid_amount', 'Total pagado')->isDefault(),
            Column::make('debt', 'Deuda')->isDefault(),
            Column::make('created_at', 'Fecha de registro')->isDefault(),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('sales.id', 'ID'),
            Filter::make('customers.name', 'Nombre cliente'),
            Filter::make('customers.surname', 'Apellido cliente'),
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
            'add-payment'
        ];
    }

    public function routesPrefix(): string
    {
        return 'pagos';
    }
}
