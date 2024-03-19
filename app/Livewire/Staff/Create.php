<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Staff;

class Create extends Component
{
    //inputs
    public $name;
    public $surname;
    public $phone;
    public $CI_number;
    public $CI_extension;
    public $CI;
    public $birthdate;

    public function render()
    {
        return view('livewire.staff.create')->layout('layouts.app-header', ['title' => 'Agregar personal']);
    }
    //validation rules
    public function rules()
    {
        $minDate = Carbon::now()->subYears(65)->format('Y-m-d');
        $maxDate = Carbon::now()->subYears(17)->format('Y-m-d');

        $this->CI = $this->CI_number . ' ' . $this->CI_extension;

        return [
            'name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'surname' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'phone' => 'required|integer|min:60000000|max:80090000|unique:staff,phone',
            'CI_number' => 'required|string|regex:/^\d+$/|min:8|max:8',
            'CI_extension' => ['required', 'string', 'min:2', 'max:2', Rule::in(['SC', 'CB', 'LP', 'PO', 'OR', 'CH', 'TJ', 'BE', 'PA'])],
            'CI' => 'unique:staff,CI',
            'birthdate' => 'required|date|before:' . $maxDate . '|after:' . $minDate,
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
            'extension' => 'extensión'
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
    public function save()
    {
        $this->validate();
        Staff::create([
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'CI' => $this->CI,
            'birthdate' => $this->birthdate,
        ]);


        return redirect()->to('personal')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Personal creado correctamente');
    }
}
