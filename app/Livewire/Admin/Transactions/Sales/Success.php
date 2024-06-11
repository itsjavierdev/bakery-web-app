<?php

namespace App\Livewire\Admin\Transactions\Sales;

use App\Models\Sale;
use App\Models\SaleDetail;
use Livewire\Component;

class Success extends Component
{
    public $sale;
    public $products;
    public $sale_detail;
    public $debt;
    public function render()
    {
        return view('livewire.admin.transactions.sales.success')->layout('layouts.admin-header', ['title' => 'Venta realizada exitosamente', 'titleAlign' => 'center']);
    }

    public function mount($sale)
    {
        $this->sale = Sale::find($sale);

        $this->products = $this->sale->products;
        $this->sale_detail = SaleDetail::where('sale_id', $this->sale->id)->get();
        $this->debt = "{$this->sale->total} {$this->sale->paid_amount}";
    }
}
