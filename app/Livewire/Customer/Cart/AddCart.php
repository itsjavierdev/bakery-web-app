<?php

namespace App\Livewire\Customer\Cart;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Facades\Cart;

class AddCart extends Component
{
    use InteractsWithBanner;

    public $product;
    public $product_id;

    public function render()
    {
        return view('livewire.customer.cart.add-cart');
    }

    #[On('addToCart')]
    public function addToCart($product_id, $quantity = 1)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login');
        }
        if (!Auth::guard('customer')->user()->customer->verified) {
            return redirect()->route('customer.not.verified');
        }
        Cart::add(Product::where('id', $product_id)->first(), $quantity);
        $this->dispatch('renderCart')->to(CartButton::class);
        $this->banner('Producto agregado al carrito');
    }
}
