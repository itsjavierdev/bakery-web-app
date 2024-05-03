<?php

namespace App\Livewire\Admin\ManagementAdmin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Detail extends Component
{
    public $role;

    public $actions = ['update', 'delete'];

    public $permissions;

    public function render()
    {
        return view('livewire.admin.management-admin.roles.detail')->layout('layouts.admin-header', ['title' => 'Detalle del Rol', 'titleAlign' => 'center']);
    }

    public function mount($role)
    {
        $this->role = Role::find($role);
        $this->permissions = $this->role->permissions->groupBy('module')->all();
    }
}
