<?php

namespace App\Livewire\Admin\Dashboard\Sales;

use Livewire\Component;

class Index extends Component
{
    public $chart_sales = "year";
    public function render()
    {
        return view('livewire.admin.dashboard.sales.index');
    }
}
