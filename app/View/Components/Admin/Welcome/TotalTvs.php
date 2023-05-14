<?php

namespace App\View\Components\Admin\Welcome;

use App\Models\Product;
use Illuminate\View\Component;

class TotalTvs extends Component
{
    public $count;
    public function __construct()
    {
        $this->count = Product::where('category_id', '=', Product::$tvCategory)->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.welcome.total-tvs');
    }
}
