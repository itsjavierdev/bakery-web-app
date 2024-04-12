<?php

namespace App\Livewire\Admin\Staff;

use Livewire\Component;
use App\Models\Staff;

class Detail extends Component
{
    public $staff;
    public $user;
    public $role;

    public $actions = ['update', 'delete'];

    public function mount($staff)
    {
        $this->staff = Staff::find($staff);
        $this->user = $this->staff->user;
        if ($this->user) {
            $this->role = $this->user->roles->first();
        }
    }

    public function render()
    {
        return view('livewire.admin.staff.detail')->layout('layouts.admin-header', ['title' => 'Detalle de Personal', 'titleAlign' => 'center']);
    }
}
