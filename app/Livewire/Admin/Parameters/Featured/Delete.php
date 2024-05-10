<?php

namespace App\Livewire\Admin\Parameters\Featured;

use App\Livewire\Others\DeleteRow;
use App\Models\Featured;
use Illuminate\Support\Facades\Storage;

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

    public function otherDeletes($id)
    {
        $featured = Featured::find($id);
        Storage::disk('public')->delete([
            "featured/720/{$featured->image}",
            "featured/378/{$featured->image}",
            "featured/160/{$featured->image}",
        ]);

    }

}
