<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\ProductImage;
use Livewire\Component;

class Detail extends Component
{
    public $product;
    public $images;
    public $actions = [
        'update',
        'delete'
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->images = ProductImage::where('product_id', $product->id)->get();
    }

    public function render()
    {
        return view('livewire.products.detail')->layout('layouts.app-header', ['title' => 'Detalle de Producto', 'titleAlign' => 'center']);
    }
}
