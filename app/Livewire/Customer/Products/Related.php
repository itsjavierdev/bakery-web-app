<?php

namespace App\Livewire\Customer\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Related extends Component
{
    public $product_id;

    public function render()
    {
        $product = Product::find($this->product_id);
        $related_products = Product::where('category_id', $product->category_id)
            ->select('products.*', DB::raw('(SELECT path FROM product_images WHERE product_images.product_id = products.id ORDER BY position LIMIT 1) as first_image'), DB::raw('price * bag_quantity as total_price'))
            ->where('id', '!=', $product->id)
            ->where('discontinued', 0)
            ->latest('created_at')
            ->limit(4)
            ->get();

        return view('livewire.customer.products.related', compact('related_products'));
    }

}
