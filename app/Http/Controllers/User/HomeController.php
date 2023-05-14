<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AdvertisingSection;
use App\Models\Slider;

class HomeController extends Controller
{

    public function index()
    {
        return view('user.home')->with([
            "AdvertisingSections" => AdvertisingSection::all(),
            "sliders" => Slider::all(),
        ]);
    }

    public function aboutUs()
    {
        return view('user.aboutus');
    }

    public function expire()
    {
        return view('user.expire');
    }
}
