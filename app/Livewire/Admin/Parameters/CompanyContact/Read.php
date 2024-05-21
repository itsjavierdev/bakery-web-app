<?php

namespace App\Livewire\Admin\Parameters\CompanyContact;

use App\Models\Address;
use Livewire\Component;
use App\Models\CompanyContact;

class Read extends Component
{
    public $company_contact;
    public $address;

    public function render()
    {
        return view('livewire.admin.parameters.company-contact.read');
    }

    public function mount()
    {

        $this->company_contact = CompanyContact::find(1);

        if (!$this->company_contact == null) {
            $this->address = Address::find($this->company_contact->address_id)->address ?? 'No hay dirección registrada';
        } else {
            $this->address = 'No hay dirección registrada';
        }


    }
}
