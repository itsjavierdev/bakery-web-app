<?php

namespace App\Livewire\Forms\Staff;

use Livewire\Form;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Staff;

class CreateFormStaff extends Form
{
    public $staff;
    //inputs
    public $name;
    public $surname;
    public $phone;
    public $CI_number;
    public $CI_extension;
    public $CI;
    public $birthdate;

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
    public function create()
    {
        $this->validate();

        //just create and array with the staff data, because if the user wants to add an account, the staff is stored in the user form
        $this->staff = [
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'CI' => $this->CI,
            'birthdate' => $this->birthdate,
        ];

        return $this->staff;
    }
    public function store($staff)
    {
        //create the staff without user account
        Staff::create($staff);
    }
}
