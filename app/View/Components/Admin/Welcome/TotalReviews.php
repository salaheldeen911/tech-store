<?php

namespace App\View\Components\Admin\Welcome;

use App\Models\Rating;
use Illuminate\View\Component;

class TotalReviews extends Component
{
    public $count;
    public function __construct()
    {
        $this->count = Rating::count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.welcome.total-reviews');
    }
}
