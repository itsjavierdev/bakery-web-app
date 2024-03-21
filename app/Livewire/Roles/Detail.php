<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Detail extends Component
{
    public $role;

    public $actions = ['update', 'delete'];

    public $permissions;

    public function render()
    {
        return view('livewire.roles.detail')->layout('layouts.app-header', ['title' => 'Detalle del Rol']);
    }

    public function mount($role)
    {
        $this->role = Role::findOrFail($role);
        $this->permissions = $this->role->permissions->groupBy('module')->all();
    }
}
