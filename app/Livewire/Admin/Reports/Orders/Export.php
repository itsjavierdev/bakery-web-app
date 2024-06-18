<?php

namespace App\Livewire\Admin\Reports\Orders;

use App\Exports\Orders\ExpiredOrders;
use App\Exports\Orders\Products;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Orders\AllOrders;
use App\Exports\Orders\ByTime;
use Barryvdh\DomPDF\Facade\Pdf;

class Export extends Component
{
    public $report_by = 'all-orders';

    public $start_date;
    public $end_date;

    public $period = 'byDate';

    public function render()
    {
        return view('livewire.admin.reports.orders.export');
    }

    public function exportExcel()
    {
        $this->validate();


        $dates = $this->getDates();

        $info = $this->getQuery();
        $data = $info[0]->get();
        $title = $info[1];

        $start_date = date('d-m-Y', strtotime($dates['start_date']));
        $end_date = date('d-m-Y', strtotime($dates['end_date']));

        switch ($this->report_by) {
            case 'all-orders':
                return Excel::download(new AllOrders($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'expired-orders':
                return Excel::download(new ExpiredOrders($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'products':
                return Excel::download(new Products($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'by-time':
                return Excel::download(new ByTime($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");
            default:
                return Excel::download(new Products($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");
        }
    }

    public function exportPDF()
    {
        $this->validate();

        $dates = $this->getDates();

        $info = $this->getQuery();
        $data = $info[0]->get();
        $title = $info[1];

        $start_date = date('d-m-Y', strtotime($dates['start_date']));
        $end_date = date('d-m-Y', strtotime($dates['end_date']));

        $pdf = Pdf::loadView('exports.orders.' . $this->report_by, ['data' => $data, 'date_start' => $start_date, 'date_end' => $end_date]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "{$title}_{$start_date}_{$end_date}.pdf");
    }

    public function getQuery()
    {
        $dates = $this->getDates();
        $start_date = $dates['start_date'];
        $end_date = $dates['end_date'];

        switch ($this->report_by) {
            case 'all-orders':
                return [$this->queryAllOrders($start_date, $end_date), 'Pedidos_Por_Entregar'];
            case 'expired-orders':
                return [$this->queryExpiredOrders($start_date, $end_date), 'Pedidos_Vencidos'];
            case 'products':
                return [$this->queryProducts($start_date, $end_date), 'Productos_Por_Entregar'];
            case 'by-time':
                return [$this->queryByTime($start_date, $end_date), 'Horas_Con_Más_Pedidos'];
            default:
                return [$this->queryAllOrders($start_date, $end_date), 'Pedidos_Por_Entregar'];
        }
    }

    public function getDates()
    {
        if ($this->period == 'byDate') {
            $start_date = Carbon::parse($this->start_date)->startOfDay();
            $end_date = Carbon::parse($this->start_date)->endOfDay();
        } else {
            $start_date = Carbon::parse($this->start_date)->startOfDay();
            $end_date = Carbon::parse($this->end_date)->endOfDay();
        }
        return ['start_date' => $start_date, 'end_date' => $end_date];
    }

    public function queryAllOrders($start_date, $end_date)
    {
        return Order::query()
            ->leftJoin('delivery_times', 'orders.delivery_time_id', '=', 'delivery_times.id')
            ->leftJoin('addresses', 'orders.address_id', '=', 'addresses.id')
            ->select(
                'orders.*',
                'orders.delivery_date as delivery_date',
                'delivery_times.time as time',
                'orders.total_quantity as total_quantity',
                'addresses.address'
            )
            ->where('orders.delivered', false)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween(\DB::raw('CONCAT(orders.delivery_date, " ", delivery_times.time)'), [$start_date, $end_date]);
            })
            ->orderBy('orders.delivery_date')
            ->orderBy('delivery_times.time');
    }

    public function queryExpiredOrders($start_date, $end_date)
    {
        return Order::query()
            ->leftJoin('delivery_times', 'orders.delivery_time_id', '=', 'delivery_times.id')
            ->select(
                'orders.*',
                'orders.delivery_date as delivery_date',
                'delivery_times.time as time',
                'orders.total_quantity as total_quantity',
            )
            ->where('orders.delivered', false)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween(\DB::raw('CONCAT(orders.delivery_date, " ", delivery_times.time)'), [$start_date, $end_date]);
            })
            ->orderBy('orders.delivery_date')
            ->orderBy('delivery_times.time');

    }

    public function queryProducts($start_date, $end_date)
    {
        return \DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'products.name',
                \DB::raw('SUM(CASE WHEN order_details.by_bag = false THEN order_details.quantity ELSE 0 END) as total_individual'),
                \DB::raw('SUM(CASE WHEN order_details.by_bag = true THEN order_details.quantity ELSE 0 END) as total_by_bag'),
                \DB::raw('SUM(order_details.subtotal) as total_amount'),
                \DB::raw('SUM(CASE WHEN order_details.by_bag = true THEN order_details.quantity * products.bag_quantity ELSE 0 END)+ SUM(CASE WHEN order_details.by_bag = false THEN order_details.quantity ELSE 0 END) as total_quantity')
            )
            ->where('orders.delivered', false)
            ->whereBetween('orders.delivery_date', [$start_date, $end_date])
            ->groupBy('products.name')
            ->orderBy('products.name');
    }

    public function queryByTime($start_date, $end_date)
    {
        return \DB::table('delivery_times')
            ->join('orders', 'delivery_times.id', '=', 'orders.delivery_time_id')
            ->select(
                'delivery_times.time as time',
                \DB::raw('COUNT(orders.id) as total_orders'),
                \DB::raw('SUM(CASE WHEN orders.address_id IS NOT NULL THEN 1 ELSE 0 END) as address_orders'),
                \DB::raw('SUM(CASE WHEN orders.address_id IS NULL THEN 1 ELSE 0 END) as no_address_orders')
            )
            ->whereBetween('orders.delivery_date', [$start_date, $end_date])
            ->groupBy('delivery_times.time')
            ->orderBy('total_orders', 'desc');
        ;
    }

    public function rules()
    {
        if ($this->report_by == 'expired-orders' || $this->report_by == 'by-time') {
            if ($this->period == 'byDate') {
                $rules = [
                    'report_by' => ['required'],
                    'start_date' => ['required', 'date', 'before:today'],
                ];
            } else {
                $rules = [
                    'report_by' => ['required'],
                    'start_date' => ['required', 'date', 'before:today'],
                    'end_date' => ['required', 'date', 'after_or_equal:start_date', 'before:today'],
                ];
            }
        } else {
            if ($this->period == 'byDate') {
                $rules = [
                    'report_by' => ['required'],
                    'start_date' => ['required', 'date', 'after_or_equal:today'],
                ];
            } else {
                $rules = [
                    'report_by' => ['required'],
                    'start_date' => ['required', 'date', 'after_or_equal:today'],
                    'end_date' => ['required', 'date', 'after_or_equal:start_date'],
                ];
            }
        }
        return $rules;
    }

    public function validationAttributes()
    {
        return [
            'report_by' => 'tipo de reporte',
            'start_date' => 'fecha de inicio',
            'end_date' => 'fecha de fin',
        ];
    }
    public function messages()
    {
        return [
            'start_date.before' => 'La fecha de inicio no puede ser mayor a la fecha actual',
            'start_date.after_or_equal' => 'La fecha de inicio no puede ser mayor a la fecha actual',
            'end_date.before' => 'La fecha de fin no puede ser mayor a la fecha actual',
            'end_date.after_or_equal' => 'La fecha de fin no puede ser menor a la fecha de inicio',
        ];
    }

}
