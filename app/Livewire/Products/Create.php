<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    //inputs
    public $name;
    public $category_id;
    public $price;
    public $bag_quantity;
    public $description;

    public $id;
    public $images = [];

    public $categories;
    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.products.create')->layout('layouts.app-header', ['title' => 'Crear Producto', 'titleALign' => 'center']);
    }
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25|unique:products,name',
            'category_id' => 'required',
            'price' => 'required|numeric|between:0,999.9',
            'bag_quantity' => 'required|integer|between:1,100',
            'description' => 'required|string|max:255',
            'images.*' => 'image|max:1024',
            'images' => 'required|array|min:1',
        ];
    }
    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
            'category_id' => 'categoría',
            'price' => 'precio',
            'bag_quantity' => 'cantidad por bolsa',
            'description' => 'descripción',
            'images.*' => 'imágenes',
        ];
    }

    public function save()
    {
        $this->validate();

        $product = Product::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'bag_quantity' => $this->bag_quantity,
            'description' => $this->description,
        ]);

        foreach ($this->images as $image) {
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $image->store('products'),
            ]);
        }

        redirect()->to('productos')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Producto creado correctamente');
    }
}
