<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\InviteController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TransferPointsController;
use App\Http\Controllers\Admin\WasteController;
use App\Http\Controllers\Admin\WasteSectionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
Route::any('register/{code}', [InviteController::class, 'register'])->name('register');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::group(['prefix' => 'admin'], function () {
        Route::get('login', [AuthController::class, 'index'])->name('admin.login');
        Route::POST('login', [AuthController::class, 'login'])->name('admin.login');

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('/', function () {
                return view('admin/index');
            })->name('adminHome');

            #============================ Admin ====================================
            Route::resource('admins', AdminController::class);

            #============================ customers ====================================
            Route::resource('customers', CustomerController::class);

            #============================ customers ====================================
            Route::resource('categories', CategoryController::class);

            #============================ products ====================================
            Route::resource('products', ProductController::class);


            #============================ wastes ====================================
            Route::resource('wastes', WasteController::class);

            #============================ wastes ====================================
            Route::resource('wastes_section', WasteSectionController::class);

            #============================ transfer points ====================================
            Route::resource('transfer_points', TransferPointsController::class);

            #============================ transfer points ====================================
            Route::resource('orders', OrderController::class);
            Route::any('destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
            Route::any('orders/show/order', [OrderController::class, 'showOrder'])->name('orders.showOrder');
            Route::any('orders/change/order/status/{id}', [OrderController::class, 'changeOrderStatus'])->name('changeOrderStatus');
            Route::any('orders/update/order/status/{id}', [OrderController::class, 'updateOrderStatus'])->name('updateOrderStatus');

            #============================ invasions ====================================
            Route::resource('invite_links', InviteController::class);



            Route::get('my_profile', [AdminController::class, 'myProfile'])->name('myProfile');
            Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

            #============================ Setting ==================================
            Route::get('setting', [SettingController::class, 'index'])->name('settingIndex');
            Route::any('setting/update/{id}', [SettingController::class, 'update'])->name('settingUpdate');

        });
    });




#=======================================================================
#============================ ROOT =====================================
#=======================================================================
    Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('key:generate');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');
        return response()->json(['status' => 'success', 'code' => 1000000000]);
    });
});
