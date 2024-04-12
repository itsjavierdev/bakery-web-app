<?php

namespace App\Livewire\Admin\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfileInformation extends Component
{
    public $staff;
    public $user;
    public $role;

    public function render()
    {
        return view('livewire.admin.profile.profile-information');
    }
    public function mount()
    {
        $this->user = Auth::user();

        $this->state = array_merge([
            'email' => $this->user->email,
        ], $this->user->withoutRelations()->toArray());

        $this->staff = $this->user->staff;
        $this->role = $this->user->roles->first();
    }
}
