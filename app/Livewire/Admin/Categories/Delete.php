<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use App\Livewire\Others\DeleteRow;

class Delete extends DeleteRow
{
    public function relatedModels(): array
    {
        return ['product'];
    }
    public function model()
    {
        return Category::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Categoría',
            'description' => '¿Estás seguro de que quieres eliminar esta categoría?',
            'success' => 'Categoría eliminada correctamente',
            'warning' => 'No puedes eliminar esta categoría porque tiene productos asociados. Elimina los productos primero y luego intenta de nuevo.'
        ];
    }
}
