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
            'success' => 'Cliente eliminado correctamente'
        ];
    }
}
