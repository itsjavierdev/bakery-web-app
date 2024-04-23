<?php

namespace App\Livewire\Admin\Orders;

use App\Livewire\Others\DeleteRow;
use App\Models\Order;

class Delete extends DeleteRow
{

    public function model()
    {
        return Order::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Pedido',
            'description' => '¿Estás seguro de que quieres eliminar este pedido?',
            'success' => 'Pedido eliminado correctamente',
        ];
    }
}
