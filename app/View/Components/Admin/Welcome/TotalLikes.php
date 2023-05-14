<?php

namespace App\View\Components\Admin\Welcome;

use App\Models\Product;
use Illuminate\View\Component;

class TotalLikes extends Component
{
    public $count;
    public function __construct()
    {
        $this->count = Product::sum('likes');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.welcome.total-likes');
    }
}
