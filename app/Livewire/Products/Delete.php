<?php

namespace App\Livewire\Products;

use App\Livewire\Others\DeleteRow;
use App\Models\Product;

class Delete extends DeleteRow
{
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
            'success' => 'Producto eliminado correctamente'
        ];
    }
}
