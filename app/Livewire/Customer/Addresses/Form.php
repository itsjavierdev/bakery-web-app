<?php

namespace App\Livewire\Customer\Addresses;

use Livewire\Component;
use App\Livewire\Forms\Customer\Addresses\CreateFormAddress;
use App\Livewire\Forms\Customer\Addresses\UpdateFormAddress;
use Livewire\Attributes\On;
use Laravel\Jetstream\InteractsWithBanner;

class Form extends Component
{
    use InteractsWithBanner;
    //Form objects
    public CreateFormAddress $address_create;
    public UpdateFormAddress $address_edit;

    //Modal form
    public $form_title = "Agregar dirección";
    public $edit_form = false;
    public $open = false;

    public function save()
    {
        $this->address_create->save();
        $this->dispatch('render')->to(Read::class);
        $this->banner('Dirección agregada correctamente');
        $this->resetExcept('address_create', 'address_edit');
    }
    public function update()
    {
        $this->address_edit->update();
        $this->updatingOpen();
        $this->dispatch('render')->to(Read::class);
        $this->banner('Dirección actualizada correctamente');
        $this->resetExcept('address_create', 'address_edit');
    }

    #[On('edit-mode')]
    public function edit($id)
    {
        $this->edit_form = true;
        $this->open = true;
        $this->form_title = "Editar dirección";
        $this->address_edit->edit($id);
    }

    public function render()
    {
        return view('livewire.customer.addresses.form');
    }

    public function updatingOpen()
    {
        if ($this->open == true) {
            $this->resetExcept('address_create', 'address_edit');
            $this->resetValidation();
            $this->address_create->reset();
            $this->address_edit->reset();
        }
    }
}

