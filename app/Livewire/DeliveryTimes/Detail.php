<?php

namespace App\Livewire\DeliveryTimes;

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
        return view('livewire.delivery-times.detail')->layout('layouts.app-header', ['title' => 'Detalle del Horario', 'titleAlign' => 'center']);
    }
}
