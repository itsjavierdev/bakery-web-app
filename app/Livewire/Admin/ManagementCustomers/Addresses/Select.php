<?php

namespace App\Livewire\Admin\ManagementCustomers\Addresses;

use App\Livewire\Others\Datatable;
use App\View\Table\Column;
use App\View\Table\Filter;
use App\Models\Address;

class Select extends Datatable
{
    public $customer_id;

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Address::query()->where('customer_id', $this->customer_id);
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('address', 'Dirección')->isDefault(),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('id', 'ID'),
            Filter::make('address', 'Dirección'),
        ];
    }

    public function actions(): array
    {
        return [
            'add'
        ];
    }

    public function routesPrefix(): string
    {
        return 'addresses';
    }
}
