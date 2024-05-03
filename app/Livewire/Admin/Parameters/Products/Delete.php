<?php

namespace App\Livewire\Admin\Parameters\Products;

use App\Livewire\Others\DeleteRow;
use App\Models\Product;

class Delete extends DeleteRow
{
    public function relatedModels(): array
    {
        return [
            'orders',
            'sales'
        ];
    }

    public function model()
    {
        return Product::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Producto',
            'description' => '¿Estás seguro de que quieres eliminar este producto?',
            'success' => 'Producto eliminado correctamente',
            'warning' => 'No puedes eliminar este producto porque tiene datos relacionados. Elimina los datos relacionados primero y luego intenta de nuevo.'
        ];
    }
}
