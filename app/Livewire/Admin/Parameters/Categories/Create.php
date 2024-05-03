<?php

namespace App\Livewire\Admin\Parameters\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Rule;

class Create extends Component
{
    //validation rules
    #[Rule('required|min:3|max:25|regex:/^[a-zA-Z\s]+$/|unique:categories,name', as: 'nombre')]
    public $name;

    public function render()
    {
        return view('livewire.admin.parameters.categories.create')->layout('layouts.admin-header', ['title' => 'Agregar categoría', 'titleAlign' => 'center']);
    }
    public function save()
    {
        $this->validate();
        Category::create(['name' => $this->name]);

        return redirect()->to('admin/categorias')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Categoría creada correctamente');
    }
}
