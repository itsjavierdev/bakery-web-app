<?php

namespace App\Livewire\Admin\DeliveryTimes;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\DeliveryTime;

class Create extends Component
{
    //inputs
    #[Rule('required|in:08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00,18:30,19:00,19:30,20:00,20:30,21:00,21:30,22:00|unique:delivery_times,time', as: 'hora')]
    public $time;
    #[Rule('boolean', as: 'disponible')]
    public $available = false;

    public $times = [
        '08:00',
        '08:30',
        '09:00',
        '09:30',
        '10:00',
        '10:30',
        '11:00',
        '11:30',
        '12:00',
        '12:30',
        '13:00',
        '13:30',
        '14:00',
        '14:30',
        '15:00',
        '15:30',
        '16:00',
        '16:30',
        '17:00',
        '17:30',
        '18:00',
        '18:30',
        '19:00',
        '19:30',
        '20:00',
        '20:30',
        '21:00',
        '21:30',
        '22:00',
    ];

    public function render()
    {
        return view('livewire.admin.delivery-times.create')->layout('layouts.admin-header', ['title' => 'Agregar horario', 'titleAlign' => 'center']);
    }

    public function save()
    {
        $this->validate();

        DeliveryTime::create(['time' => $this->time, 'available' => $this->available]);

        return redirect()->to('admin/horarios')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Horario creado correctamente');
    }
}
