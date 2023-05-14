<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class NotificationCount extends Component
{
    public $count = 0;

    public function mount()
    {
        $this->count = auth()->user()->unreadNotifications->count();
    }

    public function updateCount()
    {
        if (auth()->user()->unreadNotifications->count() !== $this->count) {

            $this->count = auth()->user()->unreadNotifications->count();
            if ($this->count !== 0) {
                $this->emit('newNotification');
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.notification-count')->with(
            'count',
            $this->count
        );
    }
}
