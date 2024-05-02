<?php

namespace App\Livewire\Admin\Customers;

use App\Models\Customer;
use App\Livewire\Others\DeleteRow;

class Delete extends DeleteRow
{
    public function model()
    {
        return Customer::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar cliente',
            'description' => '¿Estás seguro de que quieres eliminar este cliente?',
            'success' => 'Cliente eliminado correctamente',
            'other' => 'No se puede eliminar este cliente porque tiene pedidos asociados'
        ];
    }
    protected function otherValidations($id)
    {
        $customer = Customer::find($id);

        $pendingOrdersCount = $customer->orders()->where('delivered', false)->count();
        if ($pendingOrdersCount > 0) {
            return false; // El cliente tiene pedidos pendientes de entrega
        }
        return true;
    }
}
