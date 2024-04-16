<?php

namespace App\Livewire\Admin\Customers;

use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\Rule;

class Create extends Component
{
    //inputs with validation rules
    #[Rule('required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25', as: 'nombre')]
    public $name;
    #[Rule('required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25', as: 'apellido')]
    public $surname;
    #[Rule('required|integer|min:60000000|max:80090000|unique:customers,phone', as: 'teléfono')]
    public $phone;

    //Custom messages error
    public function messages()
    {
        return [
            'name.regex' => 'El campo nombre solo puede contener letras.',
            'surname.regex' => 'El campo nombre solo puede contener letras.',
            'phone.integer' => 'El campo telefono solo puede contener números.',
            'phone.min' => 'El campo telefono no es un telefono valido.',
            'phone.max' => 'El campo telefono no es un telefono valido.',
        ];
    }

    public function render()
    {
        return view('livewire.admin.customers.create')->layout('layouts.admin-header', ['title' => 'Crear cliente', 'alignTitle' => 'center']);
    }

    public function save()
    {
        $this->validate();
        Customer::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone
        ]);

        return redirect()->to('admin/clientes')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Cliente creado correctamente');
    }
}
