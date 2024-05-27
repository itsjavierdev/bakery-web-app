<?php

namespace App\Livewire\Customer\Products;

use Livewire\Component;
use App\Models\Product;
use App\Livewire\Customer\Cart\AddCart;

class Detail extends Component
{
    public $product_id;
    public $product;
    public $quantity = 1;

    public function render()
    {
        return view('livewire.customer.products.detail');
    }

    public function mount()
    {
        $this->product = Product::find($this->product_id);
    }

    public function addToCart()
    {
        $this->dispatch('addToCart', $this->product_id, $this->quantity)->to(AddCart::class);
    }
}
