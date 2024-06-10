<?php

namespace App\View\Components\Admin\Templates;

use App\Models\Payment;
use App\Models\Sale;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CompanyContact;
use App\Models\Address;

class PaymentVoucher extends Component
{
    public $company_contact;
    public $company_address;
    public $payment;
    public $sale;
    public $previous_balance
    ;

    public function __construct($payment)
    {
        $this->company_contact = CompanyContact::first();
        $this->company_address = Address::where('id', $this->company_contact->id)->first();
        $this->payment = $payment;
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

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.templates.payment-voucher', [
            'company_contact' => $this->company_contact,
            'company_address' => $this->company_address,
            'payment' => $this->payment,
            'sale' => $this->sale,
            'previous_balance' => $this->previous_balance
        ]);
    }
}
