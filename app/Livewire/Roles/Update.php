<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Update extends Component
{

    public $role;
    public $name;
    public $role_id;
    public $selected_permissions = [];

    public $permissions;
    //setting the role data in the form
    public function mount($role)
    {
        //Get all permissions grouped by module for show all
        $this->permissions = Permission::all()->groupBy('module')->all();

        $this->role = Role::findOrFail($role);
        $this->name = $this->role->name;
        $this->role_id = $this->role->id;
        //Get the permissions of the role
        $this->selected_permissions = Permission::join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $this->role_id)
            ->pluck('permissions.id')
            ->toArray();
    }
    //render with layout
    public function render()
    {
        return view('livewire.roles.update')->layout('layouts.app-header', ['title' => 'Editar rol', 'titleAlign' => 'center']);
    }
    //Validation rules
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:30|regex:/^[a-zA-Z\s]+$/|unique:roles,name,' . $this->role_id,
            'selected_permissions' => 'required|array'
        ];
    }
    //Custom attributes names
    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
            'selected_permissions' => 'permisos'
        ];
    }

    public function update()
    {
        $this->validate();

        $role = Role::findOrFail($this->role->id);
        $role->update(['name' => $this->name]);
        //Update permissions
        $permissionNames = Permission::whereIn('id', $this->selected_permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissionNames);

        return redirect()->to('roles')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Rol actualizado correctamente');
    }
}
