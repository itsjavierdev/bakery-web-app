<?php

namespace App\Livewire\Admin\Parameters\Featured;

use App\Livewire\Others\DeleteRow;
use App\Models\Featured;

class Delete extends DeleteRow
{
    public function model()
    {
        return Featured::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Imagen Destacada',
            'description' => '¿Estás seguro de que quieres eliminar esta imagen destacada?',
            'success' => 'Imagen destacada eliminada correctamente',
        ];
    }
}
