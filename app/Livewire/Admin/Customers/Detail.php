<?php

namespace App\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;

class Detail extends Component
{
    public $customer;
    public $has_account = false;
    public $actions = ['update', 'delete'];

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->has_account = $customer->user ? true : false;
    }
    public function render()
    {
        return view('livewire.admin.customers.detail')->layout('layouts.admin-header', ['title' => 'Detalle de clientes', 'titleAlign' => 'center']);
    }
}
