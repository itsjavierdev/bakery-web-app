<?php

namespace App\Livewire\Admin\Parameters\Featured;

use App\Models\Featured;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Create extends Component
{
    use WithFileUploads;

    public $open = false;

    public $product;
    public $put_filter = false;
    public $title;
    public $image;

    public function render()
    {
        return view('livewire.admin.parameters.featured.create')->layout('layouts.admin-header', ['title' => 'Crear imagen destacada', 'titleAlign' => 'center']);
    }

    public function save()
    {
        $this->validate();

        $image = $this->image->store('featured');

        Featured::create([
            'title' => $this->title,
            'image' => $image,
            'has_filter' => $this->put_filter,
            'product_id' => $this->product->id ?? null,
            'position' => Featured::count() + 1,
        ]);

        return redirect()->to('admin/destacados')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Imagen destacada creada correctamente');
    }

    #[On('add-products')]
    public function addProduct($id)
    {
        $this->product = Product::find($id);
        $this->open = false;
    }

    public function rules()
    {
        return [
            'product.id' => 'nullable|exists:products,id',
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|max:1024',
            'put_filter' => 'nullable|boolean',
        ];
    }

    public function validationAttributes()
    {
        return [
            'product.id' => 'producto',
            'title' => 'título',
            'image' => 'imagen',
            'put_filter' => 'aplicar filtro',
        ];
    }
}
