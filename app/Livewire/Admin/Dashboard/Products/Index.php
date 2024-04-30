<?php

namespace App\Livewire\Admin\Dashboard\Products;

use Livewire\Component;

class Index extends Component
{
    public $chart_product = "sellingDesc";

    public function render()
    {
        return view('livewire.admin.dashboard.products.index');
    }
}
