<?php

namespace App\Livewire\Roles;

use Spatie\Permission\Models\Role;
use App\Livewire\Others\DeleteRow;

class Delete extends DeleteRow
{
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
            'success' => 'Rol eliminado correctamente'
        ];
    }
}

