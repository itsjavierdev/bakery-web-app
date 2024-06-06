<?php

namespace App\Livewire\Admin\Transactions\Payments;

use App\Models\Payment;
use App\Models\Sale;
use Livewire\Component;

class Add extends Component
{
    public $payment;
    public $sale;
    public $paid_amount;
    public $remaining_amount;
    public $paid_remaining;

    public function render()
    {
        return view('livewire.admin.transactions.payments.add')->layout('layouts.admin-header', ['title' => 'Agregar pago', 'titleAlign' => 'center']);
    }

    public function mount($sale)
    {
        $this->sale = Sale::find($sale);
        $this->remaining_amount = $this->sale->total - $this->sale->paid_amount;
    }

    public function updatedPaidRemaining($value)
    {
        if ($value) {
            $this->paid_amount = round($this->remaining_amount, 2);
        } else {
            $this->paid_amount = null;
        }
    }

    public function add()
    {
        $this->validate();

        $this->sale->update([
            'paid_amount' => $this->sale->paid_amount + $this->paid_amount,
            'paid' => $this->sale->paid_amount + $this->paid_amount >= $this->sale->total ? '1' : '0',
        ]);

        Payment::create([
            'sale_id' => $this->sale->id,
            'amount' => $this->paid_amount,
            'staff_id' => auth()->user()->staff->id,
            'customer_id' => $this->sale->customer_id,
        ]);

        return redirect()->to('admin/deudas')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Pago agregado correctamente.');
    }

    public function rules()
    {
        return [
            'paid_amount' => 'required|numeric|min:0.01|max:' . $this->remaining_amount,
        ];
    }

    public function validationAttributes()
    {
        return [
            'paid_amount' => 'monto a abonar',
        ];
    }

    public function messages()
    {
        return [
            'paid_amount.required' => 'El campo monto a abonar es obligatorio.',
            'paid_amount.numeric' => 'El campo monto a abonar debe ser un número.',
            'paid_amount.min' => 'El campo monto a abonar debe ser mayor a 0.',
            'paid_amount.max' => 'El campo monto a abonar no debe ser mayor al monto restante.',
        ];
    }
}
