<?php

namespace App\Livewire\Customer\Addresses;

use App\Models\Address;
use App\Livewire\Others\DeleteRow;

class Delete extends DeleteRow
{
    public function relatedModels(): array
    {
        return ['orders'];
    }
    public function model()
    {
        return Address::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Dirección',
            'description' => '¿Estás seguro de que quieres eliminar esta dirección?',
            'success' => 'Dirección eliminada correctamente',
            'warning' => 'No puedes eliminar esta dirección porque tiene un pedido en curso.'
        ];
    }
}
