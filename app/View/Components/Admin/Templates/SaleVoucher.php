<?php

namespace App\View\Components\Admin\Templates;

use App\Models\Address;
use App\Models\SaleDetail;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CompanyContact;

class SaleVoucher extends Component
{
    public $company_contact;
    public $company_address;
    public $sale_details;
    public $sale;
    public $products;

    public function __construct($sale)
    {
        $this->company_contact = CompanyContact::first();
        $this->company_address = Address::where('id', $this->company_contact->id)->first();
        $this->sale = $sale;
        $this->products = $sale->products;
        $this->sale_details = SaleDetail::where('sale_id', $sale->id)->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.templates.sale-voucher', [
            'company_contact' => $this->company_contact,
            'company_address' => $this->company_address,
            'sale_details' => $this->sale_details,
            'sale' => $this->sale,
            'products' => $this->products
        ]);
    }
}
