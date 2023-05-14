<?php

namespace App\View\Components\Admin\Welcome;

use App\Models\Order;
use Illuminate\View\Component;

class TotalOrdersAmount extends Component
{
    public $count;
    public function __construct()
    {
        $this->count = Order::sum('total');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.welcome.total-orders-amount');
    }
}
