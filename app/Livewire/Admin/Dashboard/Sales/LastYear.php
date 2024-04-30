<?php

namespace App\Livewire\Admin\Dashboard\Sales;

use Livewire\Component;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LastYear extends Component
{
    public $sales_last_year;

    public function render()
    {
        return view('livewire.admin.dashboard.sales.last-year');
    }

    public function mount()
    {
        $this->sales_last_year = Sale::where('created_at', '>=', Carbon::now()->subMonths(11))
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(total) as total_income')
            )->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

    }
}
