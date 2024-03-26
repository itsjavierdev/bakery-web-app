<?php

namespace App\Livewire\Forms\User;

use Livewire\Form;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Actions\Fortify\PasswordValidationRules;

class CreateFormUser extends Form
{
    use PasswordValidationRules;
    //account inputs
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $staff;

    //validation rules
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => $this->passwordRules(),
            'role' => 'required|exists:roles,id',
            'staff' => 'required'
        ];
    }

    //Custom attributes names
    public function validationAttributes()
    {
        return [
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'role' => 'rol',
            'staff' => 'personal'
        ];
    }

    //Custom messages error
    public function messages()
    {
        return [
            'role.exists' => 'El rol seleccionado no es válido.',
            'staff.required' => 'Se requiere completar la información de personal.',
        ];
    }


    public function store(Staff $staff)
    {
        $this->staff = $staff;

        $this->validate();

        //find the role to assign
        $this->role = Role::find($this->role);

        //create the user
        User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'staff_id' => $this->staff->id,
        ])->assignRole($this->role);

    }
}
