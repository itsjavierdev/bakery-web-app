<?php

namespace App\Livewire\Admin\Parameters\Products;

use App\Models\ProductImage;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class Update extends Component
{
    use WithFileUploads;
    public $product;
    public $categories;
    //inputs
    public $name;
    public $category_id;
    public $price;
    public $bag_quantity;
    public $description;
    public $discontinued;
    public $old_images = []; //images that are already in the database
    public $new_images = []; //images introduced by the user
    public $images = []; //all images

    public function mount(Product $product)
    {
        //set inputs
        $this->product = $product;
        $this->categories = Category::all();
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->price = $product->price_by_bag;
        $this->bag_quantity = $product->bag_quantity;
        $this->description = $product->description;
        $this->discontinued = $product->discontinued ? true : false;

        $this->old_images = ProductImage::where('product_id', $product->id)->get();

        //set old images in the all images array, without query
        $this->images = ProductImage::where('product_id', $product->id)
            ->orderBy('position')
            ->get(['id', 'path', 'position'])
            ->toArray();
    }
    //update images in order in a temporary array (nothing is saved in the database)
    public function updateImagesOrder($list)
    {
        //change the position of the images
        foreach ($list as $item) {
            foreach ($this->images as &$image) {
                if ( //new images have temp_id, old images have id
                    (isset($image['id']) && $image['id'] == $item['value']) ||
                    (isset($image['temp_id']) && $image['temp_id'] == $item['value'])
                ) {
                    $image['position'] = $item['order'];
                    break;
                }
            }
        }
    }
    //set the new images in the all images array with the temporary image collect in 'path'
    public function updatedNewImages()
    {
        $position = count($this->images) + 1;

        foreach ($this->new_images as $new_image) {
            $this->images[] = [
                'temp_id' => uniqid(),
                'path' => $new_image,
                'position' => $position++,
            ];
        }
    }
    //delete image in the temporary array (nothing is saved in the database)
    public function deleteImage($identifier)
    {
        $this->images = array_filter($this->images, function ($image) use ($identifier) {
            return ( //new images have temp_id, old images have id
                (isset($image['id']) && $image['id'] != $identifier) ||
                (isset($image['temp_id']) && $image['temp_id'] != $identifier));
        });

    }
    public function update()
    {
        $this->validate();

        $price = $this->bag_quantity > 1 ? $this->price / $this->bag_quantity : $this->price;
        //update product
        $this->product->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $price,
            'price_by_bag' => $this->price,
            'bag_quantity' => $this->bag_quantity,
            'description' => $this->description,
            'discontinued' => $this->discontinued ? '1' : '0',
        ]);
        // Update the position of the images
        foreach ($this->old_images as $old_image) {
            if (!collect($this->images)->contains('id', $old_image->id)) {
                // if the old images is not in the new images array, delete it
                Storage::disk('public')->delete([
                    "products/128/{$old_image->path}",
                    "products/240/{$old_image->path}",
                    "products/400/{$old_image->path}",
                ]);
                $old_image->delete();
            } else {
                // if the old image is in the new images array, update the position
                $old_image->update([
                    'position' => collect($this->images)->firstWhere('id', $old_image->id)['position']
                ]);
            }
        }

        // Add the new images
        foreach ($this->images as $image) {
            if (isset($image['temp_id'])) {
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

                // Save the common filename in the database
                ProductImage::create([
                    'product_id' => $this->product->id,
                    'path' => $filename,
                    'position' => $image['position']
                ]);
            }
        }

        redirect()->to('admin/productos')->with('flash.banner', 'Producto actualizado correctamente')->with('flash.bannerStyle', 'success');
    }


    public function render()
    {
        //sort images by position
        $sorted_images = collect($this->images)->sortBy('position')->toArray();
        return view('livewire.admin.parameters.products.update', [
            'sorted_images' => $sorted_images,
        ])->layout('layouts.admin-header', ['title' => 'Actualizar producto', 'titleAlign' => 'center']);
    }
    //validation rules
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25|unique:products,name,' . $this->product->id,
            'category_id' => 'required',
            'price' => 'required|numeric|between:0,999.9',
            'bag_quantity' => 'required|integer|between:1,100',
            'description' => 'nullable|string|max:255',
            'new_images.*' => 'image|max:2048',
            'images' => 'required|array|min:1|max:4',
            'discontinued' => 'boolean',
        ];
    }
    //Custom attributes names
    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
            'category_id' => 'categoría',
            'price' => 'precio',
            'bag_quantity' => 'cantidad por bolsa',
            'description' => 'descripción',
            'new_images.*' => 'imágenes',
            'images' => 'imágenes',
            'discontinued' => 'descatalogado',
        ];
    }
    //Custom messages error
    public function messages()
    {
        return [
            'name.regex' => 'El campo nombre solo puede contener letras.',
            'new_images.*.image' => 'El campo imágenes solo puede contener imágenes.',
            'new_images.*.max' => 'El campo imágenes no puede pesar más de 1MB.',
        ];
    }
}
