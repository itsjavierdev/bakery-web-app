<?php

namespace App\Livewire\Admin\Parameters\DeliveryTimes;

use Livewire\Component;
use App\Models\DeliveryTime;

class Detail extends Component
{
    public $delivery_time;
    public $actions = ['update', 'delete'];

    public function mount($deliverytime)
    {
        $this->delivery_time = DeliveryTime::find($deliverytime);
    }
    public function render()
    {
        return view('livewire.admin.parameters.delivery-times.detail')->layout('layouts.admin-header', ['title' => 'Detalle del Horario', 'titleAlign' => 'center']);
    }
}
