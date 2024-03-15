<?php

namespace App\Livewire\Others;

use Livewire\Component;
use Livewire\WithPagination;


abstract class Datatable extends Component
{
    use WithPagination;

    //filters
    public $per_page = 10;
    public $sort_by = 'id';
    public $sort_direction = 'desc';
    public $search = '';
    public $search_column = '';

    public $has_id_column = false;
    public $has_created_at_column = false;


    //abstract methods
    public abstract function query(): \Illuminate\Database\Eloquent\Builder;

    public abstract function routesPrefix(): string;

    public abstract function columns(): array;

    public abstract function actions(): array;

    //id and created_at columns
    public function mount()
    {
        $this->has_id_column = array_search('id', array_column($this->columns(), 'key')) !== false;
        $this->has_created_at_column = array_search('created_at', array_column($this->columns(), 'key')) !== false;
    }
    public function render()
    {
        return view('livewire.others.datatable');
    }
    //query for show data
    public function data()
    {
        return $this
            ->query()
            ->when($this->search !== '', function ($query) {
                $this->searchQuery($query);
            })
            ->orderBy($this->sort_by, $this->sort_direction)
            ->paginate($this->per_page);
    }

    //sort by column in asc and desc order
    public function sort($key)
    {
        $this->resetPage();

        if ($this->sort_by === $key) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
            return;
        }

        $this->sort_by = $key;
        $this->sort_direction = 'asc';
    }

    //query for search data in all columns and in specific column
    protected function searchQuery($query)
    {
        $query->where(function ($query) {
            if ($this->search_column !== '') {
                //specific column search
                $column = collect($this->columns())->firstWhere('key', $this->search_column);
                $this->columnSearchFilter($query, $column);
            } else {
                //all columns search
                foreach ($this->columns() as $column) {
                    $this->columnSearchFilter($query, $column);
                }
            }
        });
    }

    //search filter for column normal or date
    protected function columnSearchFilter($query, $column)
    {
        if ($column && $column->isDate) {
            \DB::statement("SET lc_time_names = 'es_ES';");
            $query->orWhereRaw("DATE_FORMAT($column->key, '%d %b. %Y') LIKE ?", ["%$this->search%"]);
        } else {
            $query->orWhere($column->key, 'like', '%' . $this->search . '%');
        }
    }

    //reset pagination in other filters
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
}