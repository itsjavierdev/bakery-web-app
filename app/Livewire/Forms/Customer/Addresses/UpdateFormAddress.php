<?php

namespace App\Livewire\Forms\Customer\Addresses;

use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use Livewire\Form;

class UpdateFormAddress extends Form
{
    //VALIDATION RULES
    #[Rule('required|max:150', as: 'dirección')]
    public $street;

    #[Rule('max:80', as: 'referencia')]
    public $reference;

    #[Rule('required|max:40', as: 'alias')]
    public $alias;

    public $address;

    public function rules()
    {
        return [
            'street' => 'required|max:150',
            'reference' => 'max:80',
            'alias' => 'required|max:40',
        ];
    }

    public function validationAttributes()
    {
        return [
            'street' => 'dirección',
            'reference' => 'referencia',
            'alias' => 'alias',
        ];
    }

    public function edit($id)
    {
        $this->address = Address::find($id);
        $this->street = $this->address->address;
        $this->reference = $this->address->reference;
        $this->alias = $this->address->alias;
    }

    public function update()
    {
        $this->validate();
        $this->address->update([
            'address' => $this->street,
            'reference' => $this->reference,
            'alias' => $this->alias,
            'is_active' => true,
        ]);
        //Deselect another addresses
        $old_addresses = Address::where('id', '!=', $this->address->id)->where('customer_id', Auth::guard('customer')->user()->customer->id)->get();
        foreach ($old_addresses as $old_address) {
            $old_address->is_active = 0;
            $old_address->save();
        }

        $this->reset();
    }
}
