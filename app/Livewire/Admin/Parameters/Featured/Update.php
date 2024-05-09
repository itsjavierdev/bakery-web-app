<?php

namespace App\Livewire\Admin\Parameters\Featured;

use App\Models\Product;
use Livewire\Component;
use App\Models\Featured;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class Update extends Component
{
    use WithFileUploads;

    public $open;
    public $featured;
    public $image;
    public $title;
    public $product;
    public $put_filter;
    public $new_image;
    public $show;

    public function render()
    {
        return view('livewire.admin.parameters.featured.update')->layout('layouts.admin-header', ['title' => 'Actualizar imagen destacada', 'titleAlign' => 'center']);
    }

    public function mount(Featured $featured)
    {
        $this->featured = Featured::find($featured->id);
        $this->image = $this->featured->image;
        $this->title = $this->featured->title;
        $this->product = Product::find($this->featured->product_id);
        $this->put_filter = $this->featured->has_filter ? true : false;
        $this->show = $this->featured->is_active ? true : false;
    }

    public function update()
    {
        $this->validate();

        if ($this->new_image) {
            Storage::delete($this->image);
            $new_image = $this->new_image->store('featured');
        }

        $this->featured->update([
            'title' => $this->title,
            'image' => $new_image ?? $this->image,
            'has_filter' => $this->put_filter,
            'product_id' => $this->product->id ?? null,
            'is_active' => $this->show,
        ]);

        return redirect()->to('admin/destacados')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Imagen destacada actualizada correctamente');
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
            'new_image' => 'nullable|image|max:1024',
            'put_filter' => 'nullable|boolean',
            'show' => 'nullable|boolean',
        ];
    }

    public function validationAttributes()
    {
        return [
            'product.id' => 'producto',
            'title' => 'título',
            'new_image' => 'nueva imagen',
            'put_filter' => 'aplicar filtro',
            'show' => 'mostrar',
        ];
    }


}
