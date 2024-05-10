<?php

namespace App\Livewire\Admin\Parameters\Featured;

use App\Models\Product;
use Livewire\Component;
use App\Models\Featured;

class Detail extends Component
{
    public $featured;
    public $product;

    public $actions = [
        'update',
        'delete'
    ];

    public function render()
    {
        return view('livewire.admin.parameters.featured.detail')->layout('layouts.admin-header', ['title' => 'Detalle de imagen destacada', 'titleAlign' => 'center']);
    }

    public function mount(Featured $featured)
    {
        $this->featured = Featured::find($featured->id);
        $this->product = Product::find($this->featured->product_id);
    }
}
