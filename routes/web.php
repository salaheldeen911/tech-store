<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\User\ProductsController;
use App\Http\Controllers\User\LikesController;
use App\Http\Controllers\User\FilterController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\RatingController;
use App\Http\Controllers\User\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Route::get('expired', [HomeController::class, "expire"])->name("user.expire");

Route::group(['middleware' => ['user', 'active.user']], function () {

    Route::get('/', [HomeController::class, 'index'])
        ->middleware(RedirectIfAuthenticated::class)->name('welcome');

    Route::get('/filter', [FilterController::class, 'filter'])->name('filter');

    Route::get('about-us', [HomeController::class, 'aboutUs'])->name('about-us');

    Route::get('all-products', [ProductsController::class, 'index'])->name('products');
    Route::get('products/{id}', [ProductsController::class, 'show'])->name('show.product');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::resource('cart', CartController::class);

        Route::get('/wishlist', [LikesController::class, 'index'])->name('wishlist');
        Route::post('/like/{product}', [LikesController::class, 'like'])->name('like');
        Route::post('/dislike/{product}', [LikesController::class, 'disLike'])->name('disLike');

        Route::post('rating', [RatingController::class, 'store'])->name('rating.store');
        Route::delete('rating/{id}', [RatingController::class, 'destroy'])->name('rating.destroy');

        Route::get('checkout', [AddressController::class, 'index'])->name('checkout');
        Route::post('address/create', [AddressController::class, 'create'])->name('createAddress');
        Route::delete('address/{id}', [AddressController::class, 'delete'])->name('deletAddress');

        Route::get('/order', [OrderController::class, 'store'])->name('order');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    });
});
