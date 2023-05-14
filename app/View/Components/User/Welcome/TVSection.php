<?php

namespace App\View\Components\User\Welcome;

use App\Http\Resources\User\Welcome\ProductResource;
use App\Models\Product;
use Illuminate\View\Component;

class TVSection extends Component
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
        $tvs = Product::isActive()
            ->welcomeProduct()
            ->where("category_id", Product::$tvCategory)
            ->inRandomOrder()
            ->take(4)->get();

        return view('components.user.welcome.t-v-section')
            ->with("tvs", ProductResource::collection($tvs));
    }
}
