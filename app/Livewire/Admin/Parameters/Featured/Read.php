<?php

namespace App\Livewire\Admin\Parameters\Featured;

use App\Livewire\Others\Datatable;
use App\View\Table\Column;
use App\View\Table\Filter;
use App\Models\Category;
use App\Models\Featured;

class Read extends Datatable
{
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Featured::query()->leftJoin('products', 'featureds.product_id', '=', 'products.id')
            ->select(
                'featureds.id AS id',
                'featureds.title AS title',
                'featureds.image AS image',
                'featureds.is_active AS is_active',
                'featureds.has_filter AS has_filter',
                'products.name AS product',
                'featureds.created_at AS created_at'
            );
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('title', 'Titulo')->isDefault(),
            Column::make('image', 'Imagen')->isDefault()->component('admin.atoms.table.columns.image'),
            Column::make('is_active', 'Se muestra')->isDefault()->component('admin.atoms.table.columns.boolean'),
            Column::make('has_filter', 'Filtro')->component('admin.atoms.table.columns.boolean'),
            Column::make('product', 'Producto')->isDefault(),
            Column::make('created_at', 'Fecha de registro'),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('featureds.id', 'ID'),
            Filter::make('featureds.title', 'Titulo'),
            Filter::make('products.name', 'Producto'),
            Filter::make('featureds.created_at', 'Fecha de registro')->date(),
        ];
    }

    public function actions(): array
    {
        return [
            'detail',
            'update',
            'delete'
        ];
    }

    public function routesPrefix(): string
    {
        return 'featured';
    }
}
