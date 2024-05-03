<?php

namespace App\Livewire\Admin\ManagementAdmin\Users;

use App\Livewire\Others\DeleteRow;
use App\Models\User;
use App\Livewire\Admin\ManagementAdmin\Staff\Update;

class Delete extends DeleteRow
{
    public function model()
    {
        return User::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Update::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar cuenta',
            'description' => '¿Estás seguro de que quieres eliminar la cuenta de este personal?',
            'success' => 'Cuenta eliminada correctamente'
        ];
    }
}
