<?php

namespace App\Livewire\Admin\Transactions\Sales;

use App\Models\Sale;
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
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\Category;


class Report extends Component
{
    public $open = false;
    public $select = '';
    public $modal_title = '';
    public $date_start;
    public $date_end;


    public function render()
    {
        return view('livewire.admin.transactions.sales.report');
    }
    public function mount()
    {
        $this->date_start = date('Y-m-d', strtotime(Carbon::now()->subDays(30)));
        $this->date_end = date('Y-m-d', strtotime(Carbon::now()));
    }

    public function exportAllSales($ext)
    {
        $date_start = Carbon::parse($this->date_start)->startOfDay();
        $date_end = Carbon::parse($this->date_end)->endOfDay();
        $sales_data = Sale::whereBetween('created_at', [$date_start, $date_end])->get();
        $date_start = date('d-m-Y', strtotime($this->date_start));
        $date_end = date('d-m-Y', strtotime($this->date_end));

        if ($ext == 'pdf') {
            $pdf = Pdf::loadView('exports.sales.all-sales', ['data' => $sales_data, 'date_start' => $this->date_start, 'date_end' => $this->date_end]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "Ventas_{$date_start}_{$date_end}.pdf");
        }
        return Excel::download(new AllSalesExport($this->date_start, $this->date_end, $sales_data), "Ventas_{$date_start}_{$date_end}.xlsx");
    }

    public function exportByProducts($ext)
    {
        $date_start = Carbon::parse($this->date_start)->startOfDay();
        $date_end = Carbon::parse($this->date_end)->endOfDay();
        $total_sales = SaleDetail::whereBetween('created_at', [$date_start, $date_end])->sum('subtotal');

        $data = Product::leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->selectRaw('products.name AS name, products.price AS price, sum(sale_details.quantity) as quantity, sum(sale_details.subtotal) as total_amount,
            (sum(sale_details.subtotal) / ?) * 100 as percentage', [$total_sales])
            ->whereBetween('sale_details.created_at', [$date_start, $date_end])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_amount')
            ->get();

        $date_start = date('d-m-Y', strtotime($this->date_start));
        $date_end = date('d-m-Y', strtotime($this->date_end));

        if ($ext == 'pdf') {
            $pdf = Pdf::loadView('exports.sales.by-products', ['data' => $data, 'date_start' => $this->date_start, 'date_end' => $this->date_end]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "Ventas_Productos_{$date_start}_{$date_end}.pdf");
        }
        return Excel::download(new ByProduct($this->date_start, $this->date_end, $data), "Ventas_Productos_{$date_start}_{$date_end}.xlsx");
    }

    public function exportByCategories($ext)
    {
        $date_start = Carbon::parse($this->date_start)->startOfDay();
        $date_end = Carbon::parse($this->date_end)->endOfDay();

        $total_sales = SaleDetail::whereBetween('created_at', [$date_start, $date_end])->sum('subtotal');

        $data = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->select(
                'categories.name as name',
                \DB::raw('sum(sale_details.subtotal) as total_amount'),
                \DB::raw('sum(sale_details.quantity) as quantity'),
                \DB::raw('count(products.id) as total_products'),
                \DB::raw('sum(sale_details.subtotal) / ' . $total_sales . ' * 100 as percentage')
            )->groupBy('categories.id', 'categories.name')
            ->whereBetween('sale_details.created_at', [$date_start, $date_end])
            ->orderBy('total_amount', 'desc')
            ->get();

        $date_start = date('d-m-Y', strtotime($this->date_start));
        $date_end = date('d-m-Y', strtotime($this->date_end));

        if ($ext == 'pdf') {
            $pdf = Pdf::loadView('exports.sales.by-categories', ['data' => $data, 'date_start' => $this->date_start, 'date_end' => $this->date_end]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "Ventas_Categorías_{$date_start}_{$date_end}.pdf");
        }
        return Excel::download(new ByCategory($this->date_start, $this->date_end, $data), "Ventas_Categorías_{$date_start}_{$date_end}.xlsx");
    }

    public function exportByStaff($ext)
    {
        $date_start = Carbon::parse($this->date_start)->startOfDay();
        $date_end = Carbon::parse($this->date_end)->endOfDay();

        $total_sales = Sale::whereBetween('created_at', [$date_start, $date_end])->sum('total');

        $data = Staff::leftJoin('sales', 'staff.id', '=', 'sales.staff_id')
            ->select(
                \DB::raw('concat(staff.name, " ", staff.surname) as name'),
                \DB::raw('sum(sales.total) as total_amount'),
                \DB::raw('count(sales.id) as total_sales'),
                \DB::raw('sum(sales.total) / ' . $total_sales . ' * 100 as percentage')
            )->groupBy('staff.id', 'staff.name')
            ->whereBetween('sales.created_at', [$date_start, $date_end])
            ->orderBy('total_amount', 'desc')
            ->get();

        $date_start = date('d-m-Y', strtotime($this->date_start));
        $date_end = date('d-m-Y', strtotime($this->date_end));

        if ($ext == 'pdf') {
            $pdf = Pdf::loadView('exports.sales.by-staff', ['data' => $data, 'date_start' => $this->date_start, 'date_end' => $this->date_end]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "Ventas_Personal_{$date_start}_{$date_end}.pdf");
        }
        return Excel::download(new ByStaff($this->date_start, $this->date_end, $data), "Ventas_Personal_{$date_start}_{$date_end}.xlsx");
    }

    public function exportByCustomers($ext)
    {
        $date_start = Carbon::parse($this->date_start)->startOfDay();
        $date_end = Carbon::parse($this->date_end)->endOfDay();

        $total_sales = Sale::whereBetween('created_at', [$date_start, $date_end])->sum('total');

        $data = Sale::select(
            \DB::raw('concat(customers.name, " ", customers.surname) as name'),
            \DB::raw('sum(sales.total) as total_amount'),
            \DB::raw('count(sales.id) as total_sales'),
            \DB::raw('sum(sales.total) / ' . $total_sales . ' * 100 as percentage')
        )->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
            ->groupBy('customers.id', 'customers.name')
            ->whereBetween('sales.created_at', [$date_start, $date_end])
            ->orderBy('total_amount', 'desc')
            ->get();

        $date_start = date('d-m-Y', strtotime($this->date_start));
        $date_end = date('d-m-Y', strtotime($this->date_end));

        if ($ext == 'pdf') {
            $pdf = Pdf::loadView('exports.sales.by-customers', ['data' => $data, 'date_start' => $this->date_start, 'date_end' => $this->date_end]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "Ventas_Clientes_{$date_start}_{$date_end}.pdf");
        }
        return Excel::download(new ByCustomer($this->date_start, $this->date_end, $data), "Ventas_Clientes_{$date_start}_{$date_end}.xlsx");
    }

    public function toggleModal($value)
    {
        if ($value == '') {
            $this->open = false;
            return;
        }
        $this->open = true;
        $this->select = $value;
        switch ($value) {
            case 'AllSales':
                $this->modal_title = 'Ventas';
                break;
            case 'ByProducts':
                $this->modal_title = 'Reporte ventas por productos';
                break;
            case 'ByCategories':
                $this->modal_title = 'Reporte ventas por categorías';
                break;
            case 'ByStaff':
                $this->modal_title = 'Reporte ventas por personal';
                break;
            case 'ByCustomers':
                $this->modal_title = 'Reporte ventas por clientes';
                break;
        }
    }
}
