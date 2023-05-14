<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AdvertisingSectionController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\NetworkController;
use App\Http\Controllers\Admin\OperatingSystemController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProcessorController;
use App\Http\Controllers\Admin\RefreshRateController;
use App\Http\Controllers\Admin\ResolutionController;
use App\Http\Controllers\Admin\ScreenTypeController;
use App\Http\Controllers\ScreenController;
use App\Models\Product;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/admin-register', [AdminRegisterController::class, 'index'])->name('admin-register');
Route::post('/create-admin', [AdminRegisterController::class, 'register'])->name('create-admin');
Route::group(
    [
        "prefix" => "dashboard",
        'as' => 'admin.',
        'middleware' => ['auth', 'role:admin|super_admin', 'verified'],
    ],
    function () {

        Route::get('expired', [AdminController::class, "expire"])->name("expire");

        Route::group(
            ['middleware' => ['active.admin']],
            function () {

                Route::get('/', [AdminController::class, 'index'])->name("home");

                Route::get('products/show', [ProductsController::class, "showAllProducts"])->name("show.products");
                Route::get('users/show', [UsersController::class, "showAllUsers"])->name("show.users");
                Route::delete('products/rating/{id}', [ProductsController::class, "destroyRateing"]);

                Route::resource('users', UsersController::class)->except(['show']);

                Route::get('edit-slider', [SliderController::class, 'index'])->name("edit-slider");
                Route::post('update-slider', [SliderController::class, 'update'])->name("update.slider");

                Route::get('edit-advertisingSections', [AdvertisingSectionController::class, 'index'])->name("edit.advertisingSections");
                Route::post('update-advertisingSections', [AdvertisingSectionController::class, 'update'])->middleware('can:update, advetising_sections')->name("update.advertisingSections");

                Route::resource('products', ProductsController::class);
                Route::resource('/orders', OrdersController::class)->except(['edit', 'store', 'create', 'update', 'delete']);
                Route::get('orders/show/all-orders', [OrdersController::class, "showAllOrders"])->name("show.orders.show");

                Route::post('/mark-as-read', [AdminController::class, 'markNotification'])->name('markNotification');

                Route::resource('networks', NetworkController::class)->except(['show', 'store', 'create']);
                Route::get('networks/show', [NetworkController::class, "showAllNetworks"])->name("show.networks");

                Route::resource('processors', ProcessorController::class)->except(['show', 'store', 'create']);
                Route::get('processors/show', [ProcessorController::class, "showAllProcessors"])->name("show.processors");

                Route::resource('screen-types', ScreenTypeController::class)->except(['show', 'store', 'create']);
                Route::get('screen-types/show', [ScreenTypeController::class, "showAllScreenTypes"])->name("show.screen-types");

                Route::resource('refresh-rate', RefreshRateController::class)->except(['show', 'store', 'create']);
                Route::get('refresh-rate/show', [RefreshRateController::class, "showAllRefreshRate"])->name("show.refresh-rate");

                Route::resource('operating-system', OperatingSystemController::class)->except(['show', 'store', 'create']);
                Route::get('operating-system/show', [OperatingSystemController::class, "showAllOperatingSystems"])->name("show.operating-system");

                Route::resource('colors', ColorController::class)->except(['show', 'store', 'create']);
                Route::get('colors/show', [ColorController::class, "showAllcolors"])->name("show.colors");

                Route::resource('brands', BrandController::class)->except(['show', 'store', 'create']);
                Route::get('brands/show', [BrandController::class, "showAllbrands"])->name("show.brands");

                Route::resource('resolutions', ResolutionController::class)->except(['show', 'store', 'create']);
                Route::get('resolutions/show', [ResolutionController::class, "showAllresolutions"])->name("show.resolutions");
            }
        );
    }
);
