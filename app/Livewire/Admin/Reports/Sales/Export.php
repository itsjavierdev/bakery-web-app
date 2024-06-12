<?php

namespace App\Livewire\Admin\Reports\Sales;

use App\Exports\Sales\BySingleStaff;
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
use App\Exports\Sales\Daily;
use App\Exports\Sales\Monthly;
use App\Exports\Sales\Annual;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;

class Export extends Component
{
    public $period = 'daily';
    public $start_date;
    public $end_date;

    public $staff = ['id' => null, 'name' => null];
    public $open = false;
    public $report_by = "resume";


    public function render()
    {
        if ($this->period == 'byMonth' || $this->period == 'byMonths' || $this->period == 'monthly') {
            $input_type = 'month';
        } else {
            $input_type = 'date';
        }
        return view('livewire.admin.reports.sales.export', compact('input_type'));
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
            case 'by-products':
                return Excel::download(new ByProduct($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'by-categories':
                return Excel::download(new ByCategory($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'by-staff':
                return Excel::download(new ByStaff($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");

            case 'by-customers':
                return Excel::download(new ByCustomer($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");
            case 'all-sales':
                return Excel::download(new AllSalesExport($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");
            case 'by-single-staff':
                return Excel::download(new BySingleStaff($start_date, $end_date, $data, $this->staff['id']), "{$title}_{$start_date}_{$end_date}.xlsx");

            default:
                if ($this->period == 'daily') {
                    return Excel::download(new Daily($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");
                } elseif ($this->period == 'monthly') {
                    return Excel::download(new Monthly($start_date, $end_date, $data), "{$title}_{$start_date}_{$end_date}.xlsx");
                } else {
                    return Excel::download(new Annual($data), "{$title}.xlsx");
                }
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

        if ($this->report_by == 'resume') {
            if ($this->period == 'daily') {
                $pdf = Pdf::loadView('exports.sales.' . $this->period, ['data' => $data, 'date_start' => $start_date, 'date_end' => $end_date]);
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->stream();
                }, "{$title}_{$start_date}_{$end_date}.pdf");
            } elseif ($this->period == 'monthly') {
                $pdf = Pdf::loadView('exports.sales.' . $this->period, ['data' => $data, 'date_start' => $start_date, 'date_end' => $end_date]);
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->stream();
                }, "{$title}_{$start_date}_{$end_date}.pdf");
            } else {
                $pdf = Pdf::loadView('exports.sales.' . $this->period, ['data' => $data]);
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->stream();
                }, "{$title}.pdf");
            }
        } elseif ($this->report_by == 'by-single-staff') {
            $staff = Staff::find($this->staff['id']);
            $pdf = Pdf::loadView('exports.sales.by-single-staff', ['data' => $data, 'date_start' => $start_date, 'date_end' => $end_date, 'staff' => $staff]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "{$title}_{$start_date}_{$end_date}.pdf");
        } else {
            $pdf = Pdf::loadView('exports.sales.' . $this->report_by, ['data' => $data, 'date_start' => $start_date, 'date_end' => $end_date]);
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, "{$title}_{$start_date}_{$end_date}.pdf");
        }


    }

    public function queryAllSales($start_date, $end_date)
    {
        return Sale::query()->whereBetween('created_at', [$start_date, $end_date]);
    }

    public function queryDailySales($start_date, $end_date)
    {
        return Sale::query()->select(
            \DB::raw('DATE(created_at) as date'),
            \DB::raw('COUNT(id) as total_sales'),
            \DB::raw('SUM(total) as total_amount'),
            \DB::raw('AVG(total) as average_transaction'),
            \DB::raw('COUNT(DISTINCT customer_id) as unique_customers')
        )
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy(\DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc');
    }

    public function queryMonthlySales($start_date, $end_date)
    {
        return Sale::query()->select(
            \DB::raw('YEAR(created_at) as year'),
            \DB::raw('MONTH(created_at) as month'),
            \DB::raw('COUNT(id) as total_sales'),
            \DB::raw('SUM(total) as total_amount'),
            \DB::raw('AVG(total) as average_transaction'),
            \DB::raw('COUNT(DISTINCT customer_id) as unique_customers')
        )
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy(\DB::raw('MONTH(created_at)'), \DB::raw('YEAR(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc');
    }

    public function queryAnnual()
    {
        return Sale::query()->select(
            \DB::raw('YEAR(created_at) as year'),
            \DB::raw('COUNT(id) as total_sales'),
            \DB::raw('SUM(total) as total_amount'),
            \DB::raw('AVG(total) as average_transaction'),
            \DB::raw('COUNT(DISTINCT customer_id) as unique_customers')
        )
            ->groupBy(\DB::raw('YEAR(created_at)'))
            ->orderBy('year', 'asc');
    }


    public function queryByProduct($start_date, $end_date)
    {
        $total_sales = SaleDetail::whereBetween('created_at', [$start_date, $end_date])->sum('subtotal');

        return Product::query()
            ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->selectRaw(
                'products.name AS name, 
            products.price AS price, 
            products.price * products.bag_quantity AS price_by_bag,
            SUM(sale_details.quantity) AS quantity, 
            SUM(sale_details.subtotal) AS total_amount,
            (SUM(sale_details.subtotal) / ?) * 100 AS percentage,
            SUM(CASE WHEN sale_details.by_bag = false THEN sale_details.quantity ELSE 0 END) AS quantity_loose,
            SUM(CASE WHEN sale_details.by_bag = true THEN sale_details.quantity ELSE 0 END) AS quantity_by_bag',
                [$total_sales]
            )
            ->whereBetween('sale_details.created_at', [$start_date, $end_date])
            ->groupBy('products.id', 'products.name', 'products.price', 'products.bag_quantity')
            ->orderByDesc('total_amount');
        ;
    }

    public function queryByCategory($start_date, $end_date)
    {
        $total_sales = SaleDetail::whereBetween('created_at', [$start_date, $end_date])->sum('subtotal');

        return Category::query()
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
            ->select(
                'categories.name as name',
                \DB::raw('sum(sale_details.subtotal) as total_amount'),
                \DB::raw('sum(sale_details.quantity) as quantity'),
                \DB::raw('(SELECT COUNT(DISTINCT p.id) FROM products p WHERE p.category_id = categories.id) as total_products'),
                \DB::raw('sum(sale_details.subtotal) / ' . $total_sales . ' * 100 as percentage')
            )
            ->whereBetween('sale_details.created_at', [$start_date, $end_date])
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_amount', 'desc')
        ;
    }

    public function queryByStaff($start_date, $end_date)
    {
        $total_sales = Sale::whereBetween('created_at', [$start_date, $end_date])->sum('total');

        return Staff::query()->leftJoin('sales', 'staff.id', '=', 'sales.staff_id')
            ->select(
                \DB::raw('concat(staff.name, " ", staff.surname) as name'),
                \DB::raw('sum(sales.total) as total_amount'),
                \DB::raw('count(sales.id) as total_sales'),
                \DB::raw('sum(sales.total) / ' . $total_sales . ' * 100 as percentage')
            )->groupBy('staff.id', 'staff.name')
            ->whereBetween('sales.created_at', [$start_date, $end_date])
            ->orderBy('total_amount', 'desc')
        ;
    }

    public function queryByCustomer($start_date, $end_date)
    {
        $total_sales = Sale::whereBetween('created_at', [$start_date, $end_date])->sum('total');

        return Sale::query()->select(
            \DB::raw('concat(customers.name, " ", customers.surname) as name'),
            \DB::raw('sum(sales.total) as total_amount'),
            \DB::raw('count(sales.id) as total_sales'),
            \DB::raw('sum(sales.total) / ' . $total_sales . ' * 100 as percentage')
        )->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
            ->groupBy('customers.id', 'customers.name')
            ->whereBetween('sales.created_at', [$start_date, $end_date])
            ->orderBy('total_amount', 'desc')
        ;
    }

    public function queryBySingleStaff($start_date, $end_date)
    {
        return Sale::query()->where('staff_id', $this->staff['id'])
            ->whereBetween('created_at', [$start_date, $end_date])
            ->orderBy('created_at', 'asc');
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
            case 'byMonth':
                $start_date = Carbon::parse($this->start_date)->startOfMonth();
                $end_date = Carbon::parse($this->start_date)->endOfMonth();
                break;
            case 'monthly':
                $start_date = Carbon::parse($this->start_date)->startOfMonth();
                $end_date = Carbon::parse($this->end_date)->endOfMonth();
                break;

            default:
                $start_date = Carbon::parse($this->start_date)->startOfDay();
                $end_date = Carbon::parse($this->end_date)->endOfDay();
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

            case 'all-sales':
                return [$this->queryAllSales($dates['start_date'], $dates['end_date']), 'Ventas'];

            case 'by-single-staff':

                $staff = Staff::find($this->staff['id']);
                return [$this->queryBySingleStaff($dates['start_date'], $dates['end_date']), "Ventas_{$staff->name}_{$staff->surname}"];

            default:
                if ($this->period == 'daily') {
                    return [$this->queryDailySales($dates['start_date'], $dates['end_date']), 'Ventas_Diarias'];
                } elseif ($this->period == 'monthly') {
                    return [$this->queryMonthlySales($dates['start_date'], $dates['end_date']), 'Ventas_Mensuales'];
                } else {
                    return [$this->queryAnnual(), 'Ventas_Anuales'];
                }
        }
    }

    public function toggleModal($value)
    {
        if ($value == '') {
            $this->open = false;
            return;
        }
        $this->open = true;
    }

    #[On('add-staff')]
    public function addStaff($id)
    {
        $this->staff = [
            'id' => $id,
            'name' => Staff::find($id)->name
        ];
        $this->open = false;
    }

    public function updatedPeriod($value)
    {
        $this->start_date = null;
        $this->end_date = null;
    }
    public function updatedResumeBy()
    {
        $this->start_date = null;
        $this->end_date = null;
    }
    public function updatedReportBy()
    {
        $this->start_date = null;
        $this->end_date = null;
        $this->period = $this->report_by == 'resume' ? 'daily' : 'byMonth';
    }

    public function rules()
    {
        if ($this->report_by == "resume" && $this->period == "annual") {
            return [
                'report_by' => 'required',
            ];
        } else {
            $rules = [
                'start_date' => 'required',
                'report_by' => 'required',
            ];
            if ($this->report_by == 'by-single-staff') {
                $rules['staff.name'] = 'required';
            }

            if ($this->period !== 'byMonth' && $this->period !== 'byDate') {
                $rules['end_date'] = 'required|after:start_date';
            }

            return $rules;
        }
    }

    public function validationAttributes()
    {
        return [
            'start_date' => 'desde',
            'end_date' => 'hasta',
            'report_by' => 'Agrupar por',
            'staff.name' => 'Personal',
        ];
    }
}
