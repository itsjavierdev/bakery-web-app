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
            'other' => 'No puedes eliminar este pedido porque tiene un monto pagado. Elimina el monto pagado primero y luego intenta de nuevo.'
        ];
    }
    public function otherValidations($id)
    {
        $order = Order::find($id);
        if ($order->paid_amount > 0 && $order->paid_amount != null) {
            return false;

        }
        return true;
    }
}
