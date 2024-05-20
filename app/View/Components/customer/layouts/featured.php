<?php

namespace App\View\Components\customer\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Featured as FeaturedModel;

class featured extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $featured = FeaturedModel::where('id', 1)->first() ?? null;
        return view('components.customer.layouts.featured', compact('featured'));
    }
}
