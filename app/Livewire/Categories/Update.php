<?php

namespace App\Livewire\Categories;

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
        return redirect()->to('categorias')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Categoría actualizada correctamente');
    }

    public function render()
    {
        return view('livewire.categories.update')->layout('layouts.app-header', ['title' => 'Actualizar categoría']);
    }
}
