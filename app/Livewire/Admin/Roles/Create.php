<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Create extends Component
{

    //validation rules
    #[Rule('required|min:3|max:30|regex:/^[a-zA-Z\s]+$/|unique:roles,name', as: 'nombre')]
    public $name;
    #[Rule('required|array', as: 'permisos')]
    public $selected_permissions = [];

    public $permissions;

    public function mount()
    {
        $this->permissions = Permission::all()->groupBy('module')->all();
    }
    //render with layout
    public function render()
    {
        return view('livewire.admin.roles.create')->layout('layouts.admin-header', ['title' => 'Agregar rol', 'titleAlign' => 'center']);
    }
    public function save()
    {
        $this->validate();
        $role = Role::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);
        //Attach the permissions to the role
        $role->permissions()->attach($this->selected_permissions);

        return redirect()->to('roles')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Rol creado correctamente');
        ;
    }
}
