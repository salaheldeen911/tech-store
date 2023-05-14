<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        // 
    }
    public function index()
    {
        $notifications = auth()->user()->unreadNotifications;

        return view('admin.home')->with('notifications', $notifications);
    }

    public function expire()
    {
        return view('auth.expire');
    }
}
