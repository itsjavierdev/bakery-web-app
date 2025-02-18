<?php

namespace App\Livewire\Admin\ManagementAdmin\Staff;

use Livewire\Component;
use App\Livewire\Forms\Admin\Staff\UpdateFormStaff;
use App\Livewire\Forms\Admin\User\UpdateFormUser;
use App\Livewire\Forms\Admin\User\CreateFormUser;
use Spatie\Permission\Models\Role;
use App\Models\Staff;

class Update extends Component
{
    public UpdateFormStaff $staff_update;
    public UpdateFormUser $user_update;
    public CreateFormUser $user_create;

    //if the user wants to add an account
    public $has_account = false;
    public $add_account = false;
    public $staff;
    public $user;
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
        'BE'
    ];
    protected $listeners = ['render'];
    //Mount data in inputs
    public function mount(Staff $staff)
    {
        //set all roles in select input
        $this->roles = Role::all();
        $this->staff = $staff;
        $this->user = $staff->user;

        if ($this->user) {
            $this->has_account = true;
            $this->user_update->setUser($this->user);
        }
        $this->staff_update->setStaff($this->staff);
    }

    public function render()
    {

        return view('livewire.admin.management-admin.staff.update')->layout('layouts.admin-header', ['title' => 'Editar personal', 'titleAlign' => 'center']);
    }

    public function update()
    {
        $this->staff_update->validate();

        if ($this->has_account) {
            $this->user_update->update();
        } else {
            if ($this->add_account) {
                $this->user_create->store($this->staff);
            }

        }

        $this->staff_update->update();


        return redirect()->to('admin/personal')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Personal actualizado correctamente');
    }
}
