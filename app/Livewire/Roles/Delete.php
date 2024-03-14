<?php

namespace App\Livewire\Roles;

use Spatie\Permission\Models\Role;
use App\Livewire\Others\DeleteRow;

class Delete extends DeleteRow
{
    public function model()
    {
        return Role::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
}
