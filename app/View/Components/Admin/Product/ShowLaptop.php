<?php

namespace App\View\Components\Admin\Product;

use Illuminate\View\Component;

class ShowLaptop extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $product;
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.product.show-laptop');
    }
}