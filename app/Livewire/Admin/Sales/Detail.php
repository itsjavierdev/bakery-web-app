<?php

namespace App\Livewire\Admin\Sales;

use Livewire\Component;
use App\Models\Sale;
use App\Models\SaleDetail;

class Detail extends Component
{
    public $sale;
    public $products;
    public $sale_detail;
    public $debt;
    public $actions = [
        'update',
        'delete'
    ];

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
        $this->products = $sale->products;
        $this->sale_detail = SaleDetail::where('sale_id', $sale->id)->get();
        $this->debt = "$sale->total $sale->paid_amount";
    }

    public function render()
    {
        return view('livewire.admin.sales.detail')->layout('layouts.admin-header', ['title' => 'Detalle de venta', 'titleAlign' => 'center']);
    }
}

