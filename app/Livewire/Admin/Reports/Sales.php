<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Staff;
use Livewire\Component;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Sales\AllSalesExport;
use App\Exports\Sales\ByProduct;
use App\Exports\Sales\ByCategory;
use App\Exports\Sales\ByStaff;
use App\Exports\Sales\ByCustomer;
use Barryvdh\DomPDF\Facade\Pdf;

class Sales extends Component
{
    public $period = 'byMonth';
    public $start_date;
    public $end_date;
    public $report_by = "all-sales";
    public $query;

    public function render()
    {
        return view('livewire.admin.reports.sales');
    }

    public function queryAllSales($start_date, $end_date)
    {
        return Sale::whereBetween('created_at', [$start_date, $end_date])->get();
    }

    public function queryByProduct($start_date, $end_date)
    {
        $total_sales = SaleDetail::whereBetween('created_at', [$start_date, $end_date])->sum('subtotal');

        return Product::leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->selectRaw('products.name AS name, products.price AS price, sum(sale_details.quantity) as quantity, sum(sale_details.subtotal) as total_amount,
            (sum(sale_details.subtotal) / ?) * 100 as percentage', [$total_sales])
            ->whereBetween('sale_details.created_at', [$start_date, $end_date])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_amount')
            ->get();
    }

    public function queryByCategory($start_date, $end_date)
    {
        $total_sales = SaleDetail::whereBetween('created_at', [$start_date, $end_date])->sum('subtotal');

        return Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->select(
                'categories.name as name',
                \DB::raw('sum(sale_details.subtotal) as total_amount'),
                \DB::raw('sum(sale_details.quantity) as quantity'),
                \DB::raw('count(products.id) as total_products'),
                \DB::raw('sum(sale_details.subtotal) / ' . $total_sales . ' * 100 as percentage')
            )->groupBy('categories.id', 'categories.name')
            ->whereBetween('sale_details.created_at', [$start_date, $end_date])
            ->orderBy('total_amount', 'desc')
            ->get();
    }

    public function queryByStaff($start_date, $end_date)
    {
        $total_sales = Sale::whereBetween('created_at', [$start_date, $end_date])->sum('total');

        return Staff::leftJoin('sales', 'staff.id', '=', 'sales.staff_id')
            ->select(
                \DB::raw('concat(staff.name, " ", staff.surname) as name'),
                \DB::raw('sum(sales.total) as total_amount'),
                \DB::raw('count(sales.id) as total_sales'),
                \DB::raw('sum(sales.total) / ' . $total_sales . ' * 100 as percentage')
            )->groupBy('staff.id', 'staff.name')
            ->whereBetween('sales.created_at', [$start_date, $end_date])
            ->orderBy('total_amount', 'desc')
            ->get();
    }

    public function queryByCustomer($start_date, $end_date)
    {
        $total_sales = Sale::whereBetween('created_at', [$start_date, $end_date])->sum('total');

        return Sale::select(
            \DB::raw('concat(customers.name, " ", customers.surname) as name'),
            \DB::raw('sum(sales.total) as total_amount'),
            \DB::raw('count(sales.id) as total_sales'),
            \DB::raw('sum(sales.total) / ' . $total_sales . ' * 100 as percentage')
        )->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
            ->groupBy('customers.id', 'customers.name')
            ->whereBetween('sales.created_at', [$start_date, $end_date])
            ->orderBy('total_amount', 'desc')
            ->get();
    }
    public function updatedPeriod($value)
    {
        $this->start_date = null;
        $this->end_date = null;
    }

    public function exportPDF()
    {
        $this->validate();

        $dates = $this->getDates();

        $info = $this->getQuery();

        $data = $info[0];
        $title = $info[1];

        $start_date = date('d-m-Y', strtotime($dates['start_date']));
        $end_date = date('d-m-Y', strtotime($dates['end_date']));

        $pdf = Pdf::loadView('exports.sales.' . $this->report_by, ['data' => $data, 'date_start' => $start_date, 'date_end' => $end_date]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "{$title}_{$start_date}_{$end_date}.pdf");

    }
    public function getDates()
    {
        switch ($this->period) {
            case 'byMonths':
                $start_date = Carbon::parse($this->start_date)->startOfMonth();
                $end_date = Carbon::parse($this->end_date)->endOfMonth();
                break;

            case 'byDate':
                $start_date = Carbon::parse($this->start_date)->startOfDay();
                $end_date = Carbon::parse($this->start_date)->endOfDay();
                break;

            case 'byDates':
                $start_date = Carbon::parse($this->start_date)->startOfDay();
                $end_date = Carbon::parse($this->end_date)->endOfDay();
                break;

            default:
                $start_date = Carbon::parse($this->start_date)->startOfMonth();
                $end_date = Carbon::parse($this->start_date)->endOfMonth();
                break;
        }
        return ['start_date' => $start_date, 'end_date' => $end_date];
    }

    public function getQuery()
    {
        $dates = $this->getDates();

        switch ($this->report_by) {
            case 'by-products':
                return [$this->queryByProduct($dates['start_date'], $dates['end_date']), 'Ventas_Por_Productos'];

            case 'by-categories':
                return [$this->queryByCategory($dates['start_date'], $dates['end_date']), 'Ventas_Por_Categorías'];

            case 'by-staff':
                return [$this->queryByStaff($dates['start_date'], $dates['end_date']), 'Ventas_Por_Personal'];

            case 'by-customers':
                return [$this->queryByCustomer($dates['start_date'], $dates['end_date']), 'Ventas_Por_Clientes'];

            default:
                return [$this->queryAllSales($dates['start_date'], $dates['end_date']), 'Ventas'];
        }
    }

    public function exportExcel()
    {
        $this->validate();

        $dates = $this->getDates();

        $info = $this->getQuery();

        $data = $info[0];
        $title = $info[1];

        $start_date = date('d-m-Y', strtotime($dates['start_date']));
        $end_date = date('d-m-Y', strtotime($dates['end_date']));

        switch ($this->report_by) {
            case 'by-products':
                return Excel::download(new ByProduct($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'by-categories':
                return Excel::download(new ByCategory($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'by-staff':
                return Excel::download(new ByStaff($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'by-customers':
                return Excel::download(new ByCustomer($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            default:
                return Excel::download(new AllSalesExport($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");
        }

    }

    public function rules()
    {
        $rules = [
            'start_date' => 'required',
            'report_by' => 'required',
        ];

        if ($this->period !== 'byMonth' && $this->period !== 'byDate') {
            $rules['end_date'] = 'required';
        }

        return $rules;
    }

    public function validationAttributes()
    {
        return [
            'start_date' => 'desde',
            'end_date' => 'hasta',
            'report_by' => 'Agrupar por',
        ];
    }
}
