<?php

namespace App\Livewire\Customer\Products;

use App\Models\Product;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Recommended extends Component
{
    public $best_sellers_products;

    public function render()
    {
        $recent_products = Product::select(
            'products.*',
            DB::raw('(SELECT path FROM product_images WHERE product_images.product_id = products.id ORDER BY position LIMIT 1) as first_image'),
            DB::raw('price * bag_quantity as total_price')
        )
            ->latest('created_at')
            ->take(4)
            ->get()
            ->chunk(2);

        return view('livewire.customer.products.recommended', compact('recent_products'));
    }

    public function mount()
    {
        $last_month = Carbon::now()->subMonth();

        $this->best_sellers_products = DB::table('sale_details')
            ->select(
                'products.*',
                DB::raw('SUM(subtotal) as total_income'),
                DB::raw('(SELECT path FROM product_images WHERE product_images.product_id = products.id ORDER BY position LIMIT 1) as first_image'),
                DB::raw('price * bag_quantity as total_price')
            )
            ->join('products', 'sale_details.product_id', '=', 'products.id')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id')
            ->where('sales.created_at', '>=', $last_month)
            ->groupBy('products.id')
            ->orderByDesc('total_income')
            ->limit(4)
            ->get()
            ->chunk(2);

    }
}
