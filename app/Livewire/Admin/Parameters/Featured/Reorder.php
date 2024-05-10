<?php

namespace App\Livewire\Admin\Parameters\Featured;

use Livewire\Component;
use App\Models\Featured;

class Reorder extends Component
{
    public $featured = [];

    public $new_order_images = [];

    public function render()
    {
        $sorted_images = collect($this->featured)->sortBy('position')->toArray();

        return view('livewire.admin.parameters.featured.reorder', ['sorted_images' => $sorted_images])->layout('layouts.admin-header', ['title' => 'Reordenar imágenes destacadas', 'titleAlign' => 'center']);
    }

    public function mount()
    {
        $this->featured = Featured::where('is_active', true)->orderBy('position')->get(['id', 'image', 'position', 'has_filter', 'title'])->toArray();
    }

    public function updateFeaturedOrder($list)
    {
        //change the position of the images
        foreach ($list as $item) {
            foreach ($this->featured as &$image) {
                if ($image['id'] == $item['value']) {
                    $image['position'] = $item['order'];
                    break;
                }
            }
        }
    }

    public function update()
    {
        foreach ($this->featured as $image) {
            $featured = Featured::find($image['id']);
            $featured->position = $image['position'];
            $featured->save();
        }

        return redirect()->to('admin/destacados')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Imágenes destacadas reordenadas correctamente');
    }

}
