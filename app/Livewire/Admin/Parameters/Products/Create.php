<?php

namespace App\Livewire\Admin\Parameters\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    //inputs
    public $name;
    public $category_id;
    public $price;
    public $bag_quantity = 1;
    public $description;
    public $images = [];
    public $temporary_images = [];

    public $categories;
    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        $sorted_images = collect($this->temporary_images)->sortBy('position')->toArray();

        return view('livewire.admin.parameters.products.create', ['sorted_images' => $sorted_images])->layout('layouts.admin-header', ['title' => 'Crear Producto', 'titleAlign' => 'center']);
    }


    //validation rules
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25|unique:products,name',
            'category_id' => 'required',
            'price' => 'required|numeric|between:0,999.9',
            'bag_quantity' => 'required|integer|between:1,100',
            'description' => 'nullable|string|max:255',
            'images.*' => 'image|max:1024',
            'temporary_images' => 'required|array|min:1|max:4',
        ];
    }
    //custom attributes names
    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
            'category_id' => 'categoría',
            'price' => 'precio',
            'bag_quantity' => 'cantidad por bolsa',
            'description' => 'descripción',
            'images.*' => 'imágenes',
            'temporary_images' => 'imágenes'
        ];
    }
    //custom messages error
    public function messages()
    {
        return [
            'name.regex' => 'El campo nombre solo puede contener letras.',
            'images.*.image' => 'El campo imágenes solo puede contener imágenes.',
            'images.*.max' => 'El campo imágenes no puede pesar más de 1MB.',
        ];
    }

    public function save()
    {


        $this->validate();

        $price = $this->bag_quantity > 1 ? $this->price / $this->bag_quantity : $this->price;

        $product = Product::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $price,
            'bag_quantity' => $this->bag_quantity,
            'description' => $this->description,
        ]);

        foreach ($this->temporary_images as $image) {
            $filename = uniqid() . '.' . $image['path']->getClientOriginalExtension();

            // Resize and save the 400px image
            $image400 = ImageManager::imagick()->read($image['path']->getRealPath());
            $image400->cover(400, 400);

            Storage::disk('public')->put("products/400/{$filename}", (string) $image400->encodeByExtension('jpg', 80));

            // Resize and save the 240px image
            $image240 = $image400->cover(240, 240);

            Storage::disk('public')->put("products/240/{$filename}", (string) $image240->encodeByExtension('jpg', 80));

            // Resize and save the 128px image
            $image128 = $image240->cover(128, 128);

            Storage::disk('public')->put("products/128/{$filename}", (string) $image128->encodeByExtension('jpg', 80));

            //Save the common filename in the database
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $filename,
                'position' => $image['position'],
            ]);
        }

        redirect()->to('admin/productos')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Producto creado correctamente');
    }

    public function updatedImages()
    {
        $position = 1;
        foreach ($this->images as $image) {
            $this->temporary_images[] = [
                'temp_id' => uniqid(),
                'path' => $image,
                'position' => $position,
            ];
            $position++;
        }
        ;
    }
    //delete image in the temporary array (nothing is saved in the database)
    public function deleteImage($identifier)
    {
        $this->temporary_images = array_filter($this->temporary_images, function ($image) use ($identifier) {
            return $image['temp_id'] != $identifier;
        });

    }

    public function updateImagesOrder($list)
    {
        //change the position of the images
        foreach ($list as $item) {
            foreach ($this->temporary_images as &$image) {
                if ($image['temp_id'] == $item['value']) {
                    $image['position'] = $item['order'];
                    break;
                }
            }
        }
    }
}
