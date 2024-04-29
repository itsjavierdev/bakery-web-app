<?php

namespace App\Livewire\Admin\Sales;

use App\Livewire\Others\DeleteRow;
use App\Models\Sale;

class Delete extends DeleteRow
{
    public function relatedModels(): array
    {
        return ['payments'];
    }
    public function model()
    {
        return Sale::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Pedido',
            'description' => '¿Estás seguro de que quieres eliminar esta venta?',
            'success' => 'Venta eliminada correctamente',
            'warning' => 'No puedes eliminar esta venta porque tiene pagos asociados. Verifica los pagos primero y luego intenta de nuevo.'
        ];
    }
}
