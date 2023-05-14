<?php

namespace App\View\Components\User\Welcome;

use Illuminate\View\Component;

class ProductComponent extends Component
{
    private $product;
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        return view('components.user.welcome.product-component')
            ->with("product", $this->product);
    }
}
