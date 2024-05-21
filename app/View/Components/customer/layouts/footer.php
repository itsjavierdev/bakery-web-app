<?php

namespace App\View\Components\customer\layouts;

use App\Models\Address;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CompanyContact;

class footer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $company_contact = CompanyContact::first() ?? null;
        $address = null;

        if ($company_contact->address_id ?? null) {
            $address = Address::find($company_contact->address_id)->address ?? null;
        }

        return view('components.customer.layouts.footer', compact('company_contact', 'address'));
    }
}
