<?php

namespace App\Livewire\Admin\Dashboard\Sales;

use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class LastWeek extends Component
{
    public $last_week;

    public function render()
    {
        return view('livewire.admin.dashboard.sales.last-week');
    }

    public function mount()
    {
        $this->last_week = Sale::where('created_at', '>=', Carbon::now()->subWeek())
            ->select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('SUM(total) as total_income')
            )->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy('day', 'asc')
            ->get();
    }
}

