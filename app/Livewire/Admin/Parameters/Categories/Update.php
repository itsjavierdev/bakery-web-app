<?php

namespace App\Livewire\Admin\Parameters\Categories;

use Livewire\Component;
use App\Models\Category;

class Update extends Component
{
    //input
    public $name;
    public $category;
    //validation rules
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:25|regex:/^[a-zA-Z\s]+$/|unique:categories,name,' . $this->category->id,
        ];
    }
    //Custom attributes names
    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
        ];
    }
    //setting the category data in the form
    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
    }

    public function update()
    {
        $this->validate();
        $this->category->update(['name' => $this->name]);
        return redirect()->to('admin/categorias')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Categoría actualizada correctamente');
    }

    public function render()
    {
        return view('livewire.admin.parameters.categories.update')->layout('layouts.admin-header', ['title' => 'Actualizar categoría', 'titleAlign' => 'center']);
    }
}
