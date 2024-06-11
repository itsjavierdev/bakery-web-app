<?php

namespace App\View\Components\Admin\Templates;

use App\Models\Address;
use App\Models\CompanyContact;
use App\Models\Payment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllPaymentsVoucher extends Component
{
    public $company_contact;
    public $company_address;
    public $sale;
    public $payments;


    public function __construct($sale)
    {
        $this->company_contact = CompanyContact::first();
        $this->company_address = Address::where('id', $this->company_contact->id)->first();
        $this->sale = $sale;
        $this->payments = Payment::where('sale_id', $sale->id)->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.templates.all-payments-voucher', [
            'company_contact' => $this->company_contact,
            'company_address' => $this->company_address,
            'sale' => $this->sale,
            'payments' => $this->payments
        ]);
    }
}
