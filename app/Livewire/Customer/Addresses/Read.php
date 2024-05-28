<?php

namespace App\Livewire\Customer\Addresses;

use Livewire\Component;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\On;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class Read extends Component
{
    public $addresses;
    public $previous = false;

    protected $listeners = ['render'];

    public function render()
    {
        $this->addresses = Address::where('customer_id', Auth::guard('customer')->user()->customer->id)->get();

        return view('livewire.customer.addresses.read');
    }

    #[On('select-address')]
    public function selectAddress($id)
    {
        $newActiveAddress = Address::where('id', $id)->first();
        $newActiveAddress->is_active = 1;
        $newActiveAddress->save();

        $oldActiveAddress = Address::where('customer_id', Auth::guard('customer')->user()->customer->id)->where('id', '!=', $id)->get();

        foreach ($oldActiveAddress as $address) {
            $address->is_active = 0;
            $address->save();
        }
    }

    public function mount()
    {
        $previous = URL::previous();

        if (strpos($previous, 'cliente/realizar-pedido') !== false) {
            $this->previous = true;
        }
    }
}
