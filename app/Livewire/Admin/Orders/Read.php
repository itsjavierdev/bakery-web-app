<?php

namespace App\Livewire\Admin\Orders;

use App\Livewire\Others\Datatable;
use App\Views\Table\Column;
use App\Views\Table\Filter;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class Read extends Datatable
{
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Order::leftJoin('delivery_times', 'orders.delivery_time_id', '=', 'delivery_times.id')
            ->leftJoin('addresses', 'orders.address_id', '=', 'addresses.id')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(
                'orders.id AS id',
                'addresses.address AS address',
                'orders.created_at AS created_at',
                'orders.paid as paid',
                'orders.paid_amount',
                'orders.total AS total',
                DB::raw('CONCAT(orders.delivery_date, " ", delivery_times.time) AS delivery_datetime'),
                DB::raw('CONCAT_WS(" ", NULLIF(customers.name, ""), NULLIF(customers.surname, "")) AS customer'),
                DB::raw('CONCAT_WS(" ", NULLIF(customers.phone,""), NULLIF(customers.email,"")) AS customer_info'),
                DB::raw('CONCAT(COALESCE(orders.total, 0), " ", COALESCE(orders.paid_amount, 0)) AS paid_info')
            );
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('delivery_datetime', 'Fecha entrega')->component('admin.atoms.table.columns.orders.delivery-date')->isDefault(),
            Column::make('address', 'Dirección')->isDefault(),
            Column::make('customer', 'Cliente')->isDefault(),
            Column::make('customer_info', 'Información cliente')->component('admin.atoms.table.columns.orders.customer-info'),
            Column::make('total', 'Total'),
            Column::make('paid_info', 'Deuda')->component('admin.atoms.table.columns.orders.paid-info')->isDefault(),
            Column::make('created_at', 'Fecha de registro')->isDefault(),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('orders.id', 'ID'),
            Filter::make('orders.delivery_date', 'Fecha entrega')->date(),
            Filter::make('delivery_times.time', 'Hora entrega'),
            Filter::make('addresses.address', 'Dirección'),
            Filter::make('customers.name', 'Nombre cliente'),
            Filter::make('customers.surname', 'Apellido cliente'),
            Filter::make('customers.phone', 'Telefono cliente'),
            Filter::make('customers.email', 'Correo electronico cliente'),
            Filter::make('orders.total', 'Total'),
            Filter::make('orders.paid_amount', 'Total pagado'),
            Filter::make('orders.created_at', 'Fecha de registro')->date(),
        ];
    }

    public function actions(): array
    {
        return [
            'detail',
            'delivery',
            'update',
            'delete'
        ];
    }

    public function routesPrefix(): string
    {
        return 'pedidos';
    }
}
