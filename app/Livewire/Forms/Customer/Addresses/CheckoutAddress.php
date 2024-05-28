<?php

namespace App\Livewire\Forms\Customer\Addresses;

use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;
use App\Models\Address;

class CheckoutAddress extends Form
{
    //Validation rules
    #[Rule('required|max:150', as: 'dirección')]
    public $street;

    #[Rule('max:80', as: 'referencia')]
    public $reference;

    #[Rule('max:40', as: 'alias')]
    public $alias;

    public $address;
    //SAVE
    public function save()
    {
        $this->validate();
        $this->address = Address::create([
            'address' => $this->street,
            'reference' => $this->reference,
            'alias' => $this->alias,
            'customer_id' => (Auth::guard('customer')->user()->customer->id),
            'is_active' => true,
        ]);
        //Deselect another addresses
        $old_addresses = Address::where('id', '!=', $this->address->id)->where('customer_id', Auth::guard('customer')->user()->customer->id)->get();
        foreach ($old_addresses as $old_address) {
            $old_address->is_active = 0;
            $old_address->save();
        }
    }
}
