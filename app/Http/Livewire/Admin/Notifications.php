<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Notifications extends Component
{
    protected $listeners = ['newNotification' => 'setNotifications'];

    public $notifications;

    public function mount()
    {
        $this->setNotifications();
    }

    public function render()
    {
        return view('livewire.admin.notifications')->with('notifications', $this->notifications);
    }

    public function setNotifications()
    {
        $this->notifications = auth()->user()->notifications()->latest()->take(10)->get();
    }

    public function redirect($to)
    {
        return redirect($to);
    }

    public function mark()
    {
        if (auth()->user()->unreadNotifications->count()) {
            auth()->user()->unreadNotifications->markAsRead();
            $this->setNotifications();
        }
    }
}
