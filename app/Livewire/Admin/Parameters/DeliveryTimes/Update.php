<?php

namespace App\Livewire\Admin\Parameters\DeliveryTimes;

use App\Models\DeliveryTime;
use Livewire\Component;
use Carbon\Carbon;

class Update extends Component
{
    public $delivery_time;
    //inputs
    public $time;
    public $available;
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

    public function rules()
    {
        return [
            'time' => 'required|in:08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00,18:30,19:00,19:30,20:00,20:30,21:00,21:30,22:00|unique:delivery_times,time,' . $this->delivery_time->id,
            'available' => 'boolean',
        ];
    }
    public function validationAttributes()
    {
        return [
            'time' => 'hora',
            'available' => 'disponible',
        ];
    }
    public function messages()
    {
        return [
            'time.in' => 'El campo horario no está entre los valores permitidos.',
            'time.unique' => 'El campo horario ya ha sido registrada.',
        ];
    }

    public function mount(DeliveryTime $deliverytime)
    {
        $this->delivery_time = DeliveryTime::find($deliverytime->id);
        $this->time = Carbon::createFromFormat('H:i:s', $this->delivery_time->time)->format('H:i');
        $this->available = $this->delivery_time->available ? true : false;
    }
    public function update()
    {
        $this->validate();
        $this->delivery_time->update([
            'time' => $this->time,
            'available' => $this->available,
        ]);
        session()->flash('flash.banner', 'Horario actualizado correctamente');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->to('admin/horarios');
    }

    public function render()
    {
        return view('livewire.admin.parameters.delivery-times.update')->layout('layouts.admin-header', ['title' => 'Actualizar horario', 'titleAlign' => 'center']);
    }
}
