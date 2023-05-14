<?php

namespace App\View\Components\User\Welcome;

use App\Models\Product;
use Illuminate\View\Component;

class LatestSection extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $latest = Product::isActive()->welcomeProduct()
            ->latest()
            ->inRandomOrder()
            ->take(4)
            ->get();
        return view('components.user.welcome.latest-section')
            ->with("latest", $latest);
    }
}
