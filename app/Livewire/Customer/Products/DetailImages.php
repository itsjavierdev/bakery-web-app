<?php

namespace App\Livewire\Customer\Products;

use App\Models\ProductImage;
use Livewire\Component;

class DetailImages extends Component
{
    public $product_id;

    public $images;
    public $selected_image_path;

    public function render()
    {
        $selected_index = array_search(true, array_column($this->images, 'selected'));
        $this->selected_image_path = $this->images[$selected_index]['path'];

        return view('livewire.customer.products.detail-images');
    }

    public function mount()
    {
        $images = ProductImage::where('product_id', $this->product_id)->orderBy('position')->get();

        $this->images = $images->map(function ($image, $key) {
            return [
                'id' => $image->id,
                'path' => $image->path,
                'position' => $image->position,
                'selected' => $key === 0, // true solo para el primer elemento
            ];
        })->toArray();
    }

    public function selectImage($imageId)
    {
        foreach ($this->images as &$image) {
            if ($image['id'] == $imageId) {
                $image['selected'] = true;
            } else {
                $image['selected'] = false;
            }
        }
    }
}
