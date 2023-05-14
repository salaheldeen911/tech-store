<?php

namespace App\View\Components;

use Illuminate\View\Component;

class navBar extends Component
{
    public $cart;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cart = [])
    {
        $this->cart = $cart;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-bar');
    }
}
