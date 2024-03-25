<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use App\Livewire\Forms\Staff\CreateFormStaff;
use App\Livewire\Forms\User\CreateFormUser;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    //forms for separate validation user and staff
    public CreateFormStaff $staff_create;
    public CreateFormUser $user_create;

    //if the user wants to add an account
    public $add_account = false;

    public $roles;

    //CI extensions
    public $extensions = [
        'SC',
        'LP',
        'CB',
        'OR',
        'PT',
        'TJ',
        'CH',
        'PA',
        'BN'
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }
    public function render()
    {
        return view('livewire.staff.create')->layout('layouts.app-header', ['title' => 'Agregar personal']);
    }

    public function save()
    {
        $staff = $this->staff_create->create();

        //if the user wants to add an account
        if ($this->add_account) {
            $this->user_create->save($staff);
        } else {
            //if the user does not want to add an account, the staff is stored
            $this->staff_create->store($staff);
        }

        return redirect()->to('personal')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Personal creado correctamente');
    }
}
