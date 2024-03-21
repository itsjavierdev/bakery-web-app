<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Staff;

class Update extends Component
{
    public $staff;
    public $staff_id;
    //Inputs
    public $name;
    public $surname;
    public $phone;
    public $CI_number;
    public $CI_extension;
    public $CI;
    public $birthdate;
    public $is_employed;

    //Mount data in inputs
    public function mount($staff)
    {
        $this->staff = Staff::findOrFail($staff);
        $this->staff_id = $this->staff->id;
        $this->name = $this->staff->name;
        $this->surname = $this->staff->surname;
        $this->phone = $this->staff->phone;
        $this->CI_number = substr($this->staff->CI, 0, 8);
        $this->CI_extension = substr($this->staff->CI, -2);
        $this->birthdate = $this->staff->birthdate;
        $this->is_employed = $this->staff->is_employed == '1' ? true : false;
    }

    public function render()
    {
        return view('livewire.staff.update')->layout('layouts.app-header', ['title' => 'Editar personal']);
    }
    ///Validation rules
    public function rules()
    {
        $minDate = Carbon::now()->subYears(65)->format('Y-m-d');
        $maxDate = Carbon::now()->subYears(17)->format('Y-m-d');

        $this->CI = $this->CI_number . ' ' . $this->CI_extension;

        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'surname' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'phone' => 'required|integer|min:60000000|max:80090000|unique:staff,phone,' . $this->staff_id,
            'CI_number' => 'required|string|regex:/^\d+$/|min:8|max:8',
            'CI_extension' => ['required', 'string', 'max:2', Rule::in(['SC', 'CB', 'LP', 'PO', 'OR', 'CH', 'TJ', 'BE', 'PA'])],
            'CI' => 'unique:staff,CI,' . $this->staff_id,
            'birthdate' => 'required|date|before:' . $maxDate . '|after:' . $minDate,
            'is_employed' => 'required|boolean'
        ];
    }
    //Custom attributes names
    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
            'surname' => 'apellido',
            'phone' => 'teléfono',
            'CI_number' => 'carnet de identidad',
            'CI_extension' => 'extensión',
            'CI' => 'carnet de identidad',
            'birthdate' => 'fecha de nacimiento',
            'is_employed' => 'Empleado en la empresa'
        ];
    }
    //Custom messages error
    public function messages()
    {
        return [
            'name.regex' => 'El campo nombre solo puede contener letras.',
            'surname.regex' => 'El campo nombre solo puede contener letras.',
            'phone.integer' => 'El campo telefono solo puede contener números.',
            'phone.min' => 'El campo telefono no es un telefono valido.',
            'phone.max' => 'El campo telefono no es un telefono valido.',
            'CI_number.regex' => 'El campo carnet de identidad solo puede contener números.',
            'birthdate.before' => 'La persona debe ser mayor de 17 años.',
            'birthdate.after' => 'La persona debe ser menor de 65 años.',
            'phone.number' => 'El teléfono debe ser un número.',
        ];
    }

    public function update()
    {
        $this->validate();
        $this->staff->update([
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'CI' => $this->CI,
            'birthdate' => $this->birthdate,
            'is_employed' => $this->is_employed,
        ]);

        return redirect()->to('personal')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Personal actualizado correctamente');
    }
}
