<?php

namespace App\Livewire\Admin\Payments;

use App\Models\Payment;
use App\Models\Sale;
use Livewire\Component;

class Update extends Component
{
    public $sale;
    public $payments = [];
    public $total;
    public $remaining_amount;

    public $open = false;

    public function render()
    {
        return view('livewire.admin.payments.update')->layout('layouts.admin-header', ['title' => 'Actualizar Pagos', 'titleAlign' => 'center']);
    }

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
        $this->total = $sale->paid_amount;
        $payments = Payment::where('sale_id', $sale->id)->get();
        $this->remaining_amount = $this->sale->total - $this->sale->paid_amount;


        foreach ($payments as $payment) {
            $this->payments[] = [
                'id' => $payment->id,
                'staff_id' => $payment->staff->id,
                'staff_name' => $payment->staff->name,
                'staff_surname' => $payment->staff->surname,
                'amount' => $payment->amount,
                'created_at' => $payment->created_at,
            ];
        }
    }
    public function update()
    {
        $this->validate();

        $this->sale->update([
            'paid_amount' => $this->total,
            'paid' => $this->total == $this->sale->total ? true : false,
        ]);

        Payment::where('sale_id', $this->sale->id)->delete();

        foreach ($this->payments as $payment) {
            Payment::create([
                'sale_id' => $this->sale->id,
                'customer_id' => $this->sale->customer_id,
                'staff_id' => $payment['staff_id'],
                'amount' => $payment['amount'],
            ]);
        }

        return redirect()->to('admin/pagos')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Pagos actualizado correctamente.');
    }

    public function updatedPayments()
    {
        $payments = array_map(function ($payment) {
            return $payment['amount'] == null ? $payment['amount'] = 0 : $payment['amount'];
        }, $this->payments);

        $this->total = array_sum($payments);

        $this->remaining_amount = $this->sale->total - $this->total;
    }

    public function deletePayment($key)
    {
        $this->payments = array_values(array_filter($this->payments, function ($payment) use ($key) {
            return $payment['id'] != $key;
        }));
        $this->updatedPayments();
    }

    public function rules()
    {
        return [
            'payments.*.amount' => 'required|numeric|min:0.01|max:' . $this->sale->total,
            'total' => 'required|numeric|min:0.01|max:' . $this->sale->total,
        ];
    }

    public function validationAttributes()
    {
        return [
            'payments.*.amount' => 'monto',
        ];
    }

    public function messages()
    {
        return [
            'payments.*.amount.required' => 'El monto es requerido.',
            'payments.*.amount.numeric' => 'El monto debe ser un número.',
            'payments.*.amount.min' => 'El monto debe ser mayor a 0.01.',
            'payments.*.amount.max' => 'El monto no puede ser mayor al monto restante.',
        ];
    }

}
