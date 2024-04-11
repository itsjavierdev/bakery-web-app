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

    //confirmation messages
    public $confirmation_messages = ['title' => 'Eliminar registro', 'description' => '¿Estás seguro de eliminar este registro?', 'success' => 'Registro eliminado correctamente', 'warning' => 'No puedes eliminar este registro porque tiene datos relacionados. Elimina los datos relacionados primero y luego intenta de nuevo.'];

    //if redirect after delete
    public $redirect = null;

    protected $listeners = ['delete', 'confirmDelete'];

    //model to delete
    abstract protected function model();

    //if not redirect after delete, render livewire component
    abstract protected function componentToRenderAfterDelete();

    //confirmation messages defaults
    protected function confirmationMessages(): array
    {
        return ['title' => 'Eliminar registro', 'description' => '¿Estás seguro de eliminar este registro?', 'success' => 'Registro eliminado correctamente', 'warning' => 'No puedes eliminar este registro porque tiene datos relacionados. Elimina los datos relacionados primero y luego intenta de nuevo.'];
    }

    protected function relatedModels(): array
    {
        return [];
    }
    public function render()
    {
        return view('livewire.others.delete-row');
    }
    //open modal and set id to delete in confirm
    public function confirmDelete($id)
    {
        $this->delete_id = $id;
        $this->open = true;
    }

    //delete role in confirm
    public function delete($id)
    {
        $row = $this->model()::find($id);
        // Verificar relaciones
        foreach ($this->relatedModels() as $relation) {
            if ($row->$relation()->exists()) {
                $this->reset();
                $this->warningBanner($this->confirmationMessages()['warning']);
                return;
            }
        }


        $row->delete();
        //if redirect after delete
        if ($this->redirect ?? false) {
            return redirect()->route($this->redirect)->with('flash.banner', $this->confirmationMessages()['success'])->with('flash.bannerStyle', 'success');
        } else {
            //if not redirect, render component
            $this->dispatch('render')->to($this->componentToRenderAfterDelete());
            $this->reset();

            $this->banner($this->confirmationMessages()['success']);
        }

    }
}
