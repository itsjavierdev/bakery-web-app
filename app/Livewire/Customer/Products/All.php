<?php

namespace App\Livewire\Customer\Products;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class All extends Component
{
    use WithPagination;

    //Filters
    public $search;
    public $orderBy = 'orderAZ';
    public $categoryOrder = 'todos';
    public $cant = 9;

    public function render()
    {
        $categories = Category::all();

        $query = Product::query();
        //Filter by category
        if ($this->categoryOrder !== 'todos') {
            $query->where('category_id', $this->categoryOrder);
        }
        $query->select(
            'products.*',
            DB::raw('(SELECT path FROM product_images WHERE product_images.product_id = products.id ORDER BY position LIMIT 1) as first_image'),
            DB::raw('price * bag_quantity as total_price')

        )
            ->where('discontinued', 0);

        //Search
        $query->where('name', 'like', '%' . $this->search . '%');
        //Filter by select
        switch ($this->orderBy) {
            case 'orderAZ':
                $query->orderBy('name', 'asc');
                break;
            case 'orderZA':
                $query->orderBy('name', 'desc');
                break;
            case 'priceLowHigh':
                $query->orderBy('price', 'asc');
                break;
            case 'priceHighLow':
                $query->orderBy('price', 'desc');
                break;
            case 'dateOldNew':
                $query->orderBy('created_at', 'asc');
                break;
            case 'dateNewOld':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('name', 'asc');
        }
        $products = $query->paginate($this->cant);
        return view('livewire.customer.products.all', compact('products', 'categories'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingCategoryOrder()
    {
        $this->resetPage();
    }
}
