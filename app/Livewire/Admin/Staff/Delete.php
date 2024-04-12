<?php

namespace App\Livewire\Admin\Staff;

use App\Models\Staff;
use App\Livewire\Others\DeleteRow;

class Delete extends DeleteRow
{
    public function model()
    {
        return Staff::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Personal',
            'description' => '¿Estás seguro de que quieres eliminar este personal?',
            'success' => 'Personal eliminado correctamente'
        ];
    }
}
