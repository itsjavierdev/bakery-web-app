<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class NavigationMenu extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */

    public function render()
    {
        return view('livewire.admin.navigation-menu');
    }
}
