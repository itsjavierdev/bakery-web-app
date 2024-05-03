<?php

namespace App\Livewire\Admin\ManagementAdmin\Roles;

use Spatie\Permission\Models\Role;
use App\Livewire\Others\DeleteRow;

class Delete extends DeleteRow
{
    public function relatedModels(): array
    {
        return [
            'users'
        ];
    }

    public function model()
    {
        return Role::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Rol',
            'description' => '¿Estás seguro de que quieres eliminar este rol?',
            'success' => 'Rol eliminado correctamente',
            'warning' => 'No puedes eliminar un rol con usuarios asignados',
            'other' => 'No puedes eliminar el rol Administrador'
        ];
    }

    public function otherValidations($id)
    {
        $role = Role::find($id);
        if ($role->name == 'Administrador') {
            return false;
        }
        return true;
    }
}

