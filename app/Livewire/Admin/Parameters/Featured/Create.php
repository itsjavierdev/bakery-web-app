<?php

namespace App\Livewire\Admin\Parameters\Featured;

use App\Models\Featured;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

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

        $filename = uniqid() . '.' . $this->image->getClientOriginalExtension();

        // Resize and save the 720px image
        $image720 = ImageManager::imagick()->read($this->image->getRealPath());
        $image720->cover(1280, 720);

        Storage::disk('public')->put('featured/720/' . $filename, (string) $image720->encodeByExtension('jpg', 80));

        // Resize and save the 378px image
        $image378 = ImageManager::imagick()->read($this->image->getRealPath());
        $image378->cover(672, 378);

        Storage::disk('public')->put('featured/378/' . $filename, (string) $image378->encodeByExtension('jpg', 80));

        // Resize and save the 160px image
        $image160 = ImageManager::imagick()->read($this->image->getRealPath());
        $image160->cover(284, 160);

        Storage::disk('public')->put('featured/160/' . $filename, (string) $image160->encodeByExtension('jpg', 80));

        // Create the featured with common image filename
        Featured::create([
            'title' => $this->title,
            'image' => $filename,
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
