<?php

namespace App\Livewire\Admin\Products;

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
        $this->images = ProductImage::where('product_id', $product->id)->orderBy('position')->get();
    }

    public function render()
    {
        return view('livewire.admin.products.detail')->layout('layouts.admin-header', ['title' => 'Detalle de Producto', 'titleAlign' => 'center']);
    }
}
