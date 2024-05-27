<?php

namespace App\Livewire\Customer\Cart;

use Livewire\Component;
use App\Facades\Cart as CartFacade;
use Livewire\Attributes\On;

class CartButton extends Component
{
    public $cart;

    public $total_quantity;

    #[On('renderCart')]
    public function render()
    {
        $this->cart = CartFacade::get();
        $this->total_quantity = CartFacade::totalQuantity();
        return view('livewire.customer.cart.cart-button');
    }
}
