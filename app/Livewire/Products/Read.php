<?php

namespace App\Livewire\Products;

use App\Livewire\Others\Datatable;
use App\Models\Product;
use App\Views\Table\Column;
use App\Views\Table\Filter;

class Read extends Datatable
{

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name AS category');

    }
    public function columns(): array
    {
        return [
            Column::make('id', 'ID')->isDefault(),
            Column::make('created_at', 'Fecha de registro')->isDefault(),
            Column::make('name', 'Nombre')->isDefault(),
            Column::make('price', 'Precio')->isDefault(),
            Column::make('category', 'Categoría')->isDefault(),
            Column::make('description', 'Descripción'),
            Column::make('bag_quantity', 'Cantidad por paquete'),
            Column::make('discontinued', 'Descontinuado')->component('columns.boolean'),
        ];
    }
    public function filters(): array
    {
        return [
            Filter::make('products.id', 'ID'),
            Filter::make('products.name', 'Nombre'),
            Filter::make('description', 'Descripción'),
            Filter::make('categories.name', 'Categoría'),
            Filter::make('price', 'Precio'),
            Filter::make('bag_quantity', 'Cantidad por paquete'),
            Filter::make('products.created_at', 'Fecha de registro'),
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
        return 'productos';
    }

}
