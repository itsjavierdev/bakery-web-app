<?php

namespace App\Livewire\Others;

use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

abstract class DeleteRow extends Component
{
    use InteractsWithBanner;

    //for open confirmation modal
    public $open = false;
    //role id to delete
    public $delete_id;

    protected $listeners = ['delete', 'confirmDelete'];
    public function render()
    {
        return view('livewire.others.delete-row');
    }
    abstract protected function model();
    abstract protected function componentToRenderAfterDelete();
    //open modal and set id to delete in confirm
    public function confirmDelete($id)
    {
        $this->delete_id = $id;
        $this->open = true;
    }
    //delete role in confirm
    public function delete($id)
    {
        $row = $this->model()::findOrFail($id);
        $row->delete();
        //reset component and updating table
        $this->dispatch('render')->to($this->componentToRenderAfterDelete());
        $this->reset();

        $this->banner('Registro eliminado correctamente');
    }
}
