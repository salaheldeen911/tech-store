<?php

namespace App\Providers;

use App\Models\Like;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Address;
use App\Models\Brand;
use App\Models\AdvertisingSection;
use App\Models\Order;
use App\Models\Slider;
use App\Observers\OrderObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer("user.orders", function ($view) {

            $view->with('addresses', Address::class);
        });

        // User routes
        // View::composer(["/", "user.home", "user.checkout", "user.cart"], function ($view) {
        //     $view->with('products', Product::class);
        // });
        // View::composer(["user.products.show"], function ($view) {
        //     $view->with(['user' => User::class, "products" => Product::class]);
        // });

        View::composer("*", function ($view) {
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::user()->id)->first();
                // dd(Auth::user()->id);

                $view->with('cart', $cart);
            }
        });

        // Order::observe(OrderObserver::class);


        // Paginator::useBootstrap();
    }
}
