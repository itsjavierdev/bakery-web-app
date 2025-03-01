<?php

namespace App\Livewire\Admin\ManagementCustomers\Customers;

use App\Mail\CustomerApproved;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\Customer;

class Update extends Component
{
    public $customer;

    //inputs with validation rules 
    public $name;
    public $surname;
    public $phone;
    public $email;
    public $verified;

    //validation rules
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:40',
            'surname' => 'nullable|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'phone' => 'required|integer|min:60000000|max:80090000|unique:customers,phone,' . $this->customer->id,
            'email' => 'nullable|string|email|max:255|unique:customers,email,' . $this->customer->id,
            'verified' => 'boolean'
        ];

    }
    //Custom attributes names
    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
            'surname' => 'apellido',
            'phone' => 'teléfono',
            'email' => 'correo electrónico',
            'verified' => 'verificado'
        ];
    }
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

    public function mount(Customer $customer)
    {
        $this->customer = Customer::find($customer->id);
        $this->name = $this->customer->name;
        $this->surname = $this->customer->surname;
        $this->phone = $this->customer->phone;
        $this->email = $this->customer->email;
        $this->verified = $this->customer->verified == '1' ? true : false;
    }
    public function render()
    {
        return view('livewire.admin.management-customers.customers.update')->layout('layouts.admin-header', ['title' => 'Actualizar cliente', 'titleAlign' => 'center']);
    }
    public function update()
    {
        $this->validate();

        $currentVerified = $this->customer->verified == 1;
        $newVerified = $this->verified == 1;

        $isVerifiedChanged = $currentVerified === false && $newVerified === true;

        $this->customer->update([
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'email' => $this->email,
            'verified' => $this->verified ? true : false
        ]);

        if ($isVerifiedChanged) {
            Mail::to($this->customer->email)->send(new CustomerApproved($this->customer));
        }

        return redirect()->to('admin/clientes')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Cliente actualizado correctamente');
    }
}
