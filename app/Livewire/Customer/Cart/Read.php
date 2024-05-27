<?php

namespace App\Livewire\Customer\Cart;

use App\Facades\Cart as CartFacade;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class Read extends Component
{
    use InteractsWithBanner;

    public $cart;
    public $quantities = [];
    public $total;

    public function mount(): void
    {
        $this->cart = CartFacade::get();
        foreach ($this->cart['products'] as $product) {
            $this->quantities[$product['id']] = $product['quantity'];
        }

    }
    public function render()
    {
        foreach ($this->cart['products'] as &$product) {
            // Obtén el primer producto image según la posición
            $firstImage = DB::table('product_images')
                ->where('product_id', $product['id'])
                ->orderBy('position')
                ->value('path');

            // Agrega el path de la primera imagen al producto
            $product['first_image'] = $firstImage;
        }


        $this->total = CartFacade::total();

        return view('livewire.customer.cart.read');
    }
    public function removeFromCart($productId): void
    {
        CartFacade::remove($productId);
        $this->cart = CartFacade::get();


        $this->banner('Producto eliminado');
    }
    public function checkout(): void
    {
        CartFacade::clear();
        $this->cart = CartFacade::get();
    }

    public function updateQuantity($productId): void
    {
        $cart = $this->cart;
        $index = array_search($productId, array_column($cart['products'], 'id'));


        if ($index !== false) {
            $cart['products'][$index]['quantity'] = $this->quantities[$productId];
            $total_price = $cart['products'][$index]['bag_quantity'] * $cart['products'][$index]['price'];
            $cart['products'][$index]['subtotal'] = $cart['products'][$index]['quantity'] * $total_price;
            $cart['products'][$index]['subtotal_price'] = $total_price;

            CartFacade::set($cart);
            $this->cart = $cart; // Update the component's cart state
            $this->totalQuantity = CartFacade::totalQuantity(); // Update total quantity
        }

        $this->banner('Cantidad actualizada');
    }

}
