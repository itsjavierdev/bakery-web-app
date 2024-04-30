<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;

class Charts extends Component
{
    public $chart_product = "sellingDesc";

    public function render()
    {
        return view('livewire.admin.dashboard.charts');
    }
}
