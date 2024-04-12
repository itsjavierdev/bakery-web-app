<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;

class Detail extends Component
{
    public $category;
    public $actions = ['update', 'delete'];

    public function mount(Category $category)
    {
        $this->category = $category;
    }
    public function render()
    {
        return view('livewire.admin.categories.detail')->layout('layouts.admin-header', ['title' => 'Detalle de categoría', 'titleAlign' => 'center']);
    }
}
