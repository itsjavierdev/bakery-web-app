<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Sale;
use Livewire\Component;

class Detail extends Component
{
    public $sale;
    public $payments;
    public $remaining_amount;

    public $actions = [
        'add-payment',
        'update'
    ];

    public function render()
    {
        return view('livewire.admin.payments.detail')->layout('layouts.admin-header', ['title' => 'Detalle de pagos', 'titleAlign' => 'center']);
    }

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
        $this->payments = $sale->payments;
        $this->remaining_amount = $sale->total - $sale->paid_amount;
    }
}
