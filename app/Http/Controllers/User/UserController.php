<?php

namespace App\Http\Controllers\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }
}
