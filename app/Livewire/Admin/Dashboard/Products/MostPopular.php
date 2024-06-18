<?php

namespace App\Livewire\Admin\Dashboard\Products;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\SaleDetail;
use Carbon\Carbon;

class MostPopular extends Component
{
    public $best_sellers;

    public function render()
    {
        return view('livewire.admin.dashboard.products.most-popular');
    }

    public function mount()
    {
        $this->best_sellers = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(CASE WHEN sale_details.by_bag = true THEN sale_details.quantity * products.bag_quantity ELSE 0 END)+ SUM(CASE WHEN sale_details.by_bag = false THEN sale_details.quantity ELSE 0 END) as total_sold'))
            ->whereBetween('sale_details.created_at', [Carbon::now()->subMonth(), Carbon::now()])
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->limit(10)
            ->get();

    }
}
