<?php

namespace App\Livewire\Admin\DeliveryTimes;

use App\Models\DeliveryTime;
use App\Livewire\Others\DeleteRow;

class Delete extends DeleteRow
{
    public function relatedModels(): array
    {
        return ['order'];
    }
    public function model()
    {
        return DeliveryTime::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Horario',
            'description' => '¿Estás seguro de que quieres eliminar este horario?',
            'success' => 'Horario eliminado correctamente',
            'warning' => 'No puedes eliminar esta horario porque tiene pedidos asociados. Elimina o envía los pedidos primero y luego intenta de nuevo.'
        ];
    }
}
