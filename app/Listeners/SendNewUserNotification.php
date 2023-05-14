<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $admins = User::whereHas('roles', function ($query) {
        //     $query->where('id', 1);
        // })->get();
        $admins = User::role(['super_admin', 'admin'])->get();

        Notification::send($admins, new NewUserNotification($event->user));
    }
}
