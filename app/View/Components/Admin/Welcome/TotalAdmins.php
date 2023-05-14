<?php

namespace App\View\Components\Admin\Welcome;

use Illuminate\View\Component;

class TotalAdmins extends Component
{
    public $count;
    public function __construct()
    {
        $this->count = auth()->user()->role(['admin', 'super_admin'])->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.welcome.total-admins');
    }
}
