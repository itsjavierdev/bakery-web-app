<?php

namespace App\Livewire\Forms\User;

use Livewire\Form;
use App\Models\User;
use App\Models\Staff;
use Spatie\Permission\Models\Role;
use App\Actions\Fortify\PasswordValidationRules;

class UpdateFormUser extends Form
{
    use PasswordValidationRules;

    public $user;
    //account inputs
    public $email;
    public $role;
    public $is_active;


    //validation rules
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'role' => 'required|exists:roles,id',
            'is_active' => 'required|boolean'
        ];
    }

    //Custom attributes names
    public function validationAttributes()
    {
        return [
            'email' => 'correo electrónico',
            'role' => 'rol',
            'is_active' => 'Cuenta activa'
        ];
    }

    //Custom messages error
    public function messages()
    {
        return [

        ];
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->email = $user->email;
        $this->role = $user->roles->first()->id;
        $this->is_active = $user->is_active == '1' ? true : false;
    }


    public function update()
    {
        $this->validate();

        $this->user->update([
            'email' => $this->email,
            'is_active' => $this->is_active
        ]);

        $this->role = Role::find($this->role);
        $this->user->syncRoles($this->role);
    }
}
