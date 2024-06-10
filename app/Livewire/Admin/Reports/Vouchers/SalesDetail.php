<?php

namespace App\Livewire\Admin\Reports\Vouchers;

use Livewire\Component;
use App\Models\Sale;
use App\Models\SaleDetail;

class SalesDetail extends Component
{
    public $sale;
    public $payments;
    public $remaining_amount;
    public $actions = [
        'print'
    ];

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
        $this->payments = $sale->payments;
        $this->remaining_amount = $sale->total - $sale->paid_amount;
    }
    public function render()
    {
        return view('livewire.admin.reports.vouchers.sales-detail')->layout('layouts.admin-header', ['title' => 'Detalle de venta', 'titleAlign' => 'center']);
    }
}
