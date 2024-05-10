<?php

namespace App\Livewire\Admin\Parameters\Products;

use App\Livewire\Others\DeleteRow;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class Delete extends DeleteRow
{
    public function relatedModels(): array
    {
        return [
            'orders',
            'sales',
            'featured'
        ];
    }

    public function model()
    {
        return Product::class;
    }
    public function componentToRenderAfterDelete()
    {
        return Read::class;
    }
    protected function confirmationMessages(): array
    {
        return [
            'title' => 'Eliminar Producto',
            'description' => '¿Estás seguro de que quieres eliminar este producto?',
            'success' => 'Producto eliminado correctamente',
            'warning' => 'No puedes eliminar este producto porque tiene datos relacionados. Elimina los datos relacionados primero y luego intenta de nuevo.'
        ];
    }

    public function otherDeletes($id)
    {
        $product = Product::find($id);
        $images = ProductImage::where('product_id', $product->id)->get();
        foreach ($images as $image) {
            Storage::disk('public')->delete([
                "products/128/{$image->path}",
                "products/240/{$image->path}",
                "products/400/{$image->path}",
            ]);
        }
    }
}
