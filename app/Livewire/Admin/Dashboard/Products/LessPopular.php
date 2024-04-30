<?php

namespace App\Livewire\Admin\Dashboard\Products;

use Livewire\Component;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LessPopular extends Component
{
    public $less_sellers;

    public function render()
    {
        return view('livewire.admin.dashboard.products.less-popular');
    }

    public function mount()
    {
        $this->less_sellers = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(sale_details.quantity) as total_sold'))
            ->whereBetween('sale_details.created_at', [Carbon::now()->subMonth(), Carbon::now()])
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'asc')
            ->limit(10)
            ->get();
    }
}
