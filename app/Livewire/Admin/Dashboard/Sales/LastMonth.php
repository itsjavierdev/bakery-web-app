<?php

namespace App\Livewire\Admin\Dashboard\Sales;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LastMonth extends Component
{
    public $last_month;

    public function render()
    {
        return view('livewire.admin.dashboard.sales.last-month');
    }

    public function mount()
    {
        $this->last_month = Sale::where('created_at', '>=', Carbon::now()->subMonth())
            ->select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('SUM(total) as total_income')
            )->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy('day', 'asc')
            ->get();
    }
}
