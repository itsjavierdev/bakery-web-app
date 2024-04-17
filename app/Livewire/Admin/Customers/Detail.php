<?php

namespace App\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Address;

class Detail extends Component
{
    public $customer;
    public $addresses;
    public $has_account = false;
    public $actions = ['update', 'delete'];

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->has_account = $customer->user ? true : false;
        $this->addresses = Address::where('customer_id', $customer->id)->get();
    }
    public function render()
    {
        return view('livewire.admin.customers.detail')->layout('layouts.admin-header', ['title' => 'Detalle de clientes', 'titleAlign' => 'center']);
    }
}
