<?php

namespace App\Livewire\Admin\Transactions\Payments;

use App\Models\Payment;
use Livewire\Component;
use App\Models\Sale;

class Success extends Component
{
    public $payment;
    public $sale;
    public $previous_balance;

    public function render()
    {
        return view('livewire.admin.transactions.payments.success')->layout('layouts.admin-header', ['title' => 'Pago exitoso', 'titleAlign' => 'center']);
    }

    public function mount($payment)
    {
        $this->payment = Payment::find($payment);
        $this->sale = Sale::where('id', $this->payment->sale_id)->first();
        $sale_payments = Payment::where('sale_id', $this->payment->sale_id)
            ->orderBy('created_at', 'asc')
            ->get();
        $total_previous_payments = 0;

        // Contar el número de pagos
        $count = $sale_payments->count();

        if ($count > 1) {
            // Sumar todos los pagos menos el último
            for ($i = 0; $i < $count - 1; $i++) {
                $total_previous_payments += $sale_payments[$i]->amount;
            }
        }
        $this->previous_balance = $this->sale->total - $total_previous_payments;
    }
}
