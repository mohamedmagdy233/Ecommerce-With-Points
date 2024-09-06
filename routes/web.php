<?php

use App\Http\Controllers\Web\MainController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


//Route::get('/', function () {
//    return view('user/index');
//})->name('main.index');

Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::get('login', [MainController::class, 'ShowLoginForm'])->name('main.login');
Route::post('login', [MainController::class, 'login'])->name('login');
Route::get('register', [MainController::class, 'showRegisterForm'])->name('main.register');
Route::post('register', [MainController::class, 'registerNewCustomer'])->name('registerNewCustomer');
Route::group(['middleware' => 'web-auth'], function () {


    Route::get('logout', [MainController::class, 'logout'])->name('logout');
    Route::post('add/to/cart', [MainController::class, 'addToCart'])->name('addToCart');
    Route::get('add/to/cart/{id}', [MainController::class, 'addOneProductToCart'])->name('addOneProductToCart');
    Route::post('update/to/cart', [MainController::class, 'updateQuantityOfCart'])->name('updateQuantityOfCart');
    Route::post('delete/from/cart/{id}', [MainController::class, 'deleteFromCart'])->name('deleteFromCart');
    Route::get('show/cart', [MainController::class, 'showCart'])->name('showCart');
    Route::post('add/to/fav/{id}', [MainController::class, 'addToFav'])->name('addToFav');
    Route::get('get/wishlist', [MainController::class, 'getWishlist'])->name('wishlist');


    Route::get('add/order', [MainController::class, 'addOrder'])->name('addOrder');



});

#==================================auth========================




Route::get('products', [MainController::class, 'showProductsInSlider'])->name('main.products');
Route::get('products/details/{id}', [MainController::class, 'productDetails'])->name('product.details');

Route::get('products/by/category/{id}', [MainController::class, 'productsByCategory'])->name('productsByCategory');

Route::get('contact', [MainController::class, 'ShowContact'])->name('main.ShowContact');
Route::get('about', [MainController::class, 'about'])->name('main.about');
Route::post('store/contact', [MainController::class, 'storeContact'])->name('main.storeContact');
Route::get('terms/privacy/faqs', [MainController::class, 'termsAndPrivacyAndFaqs'])->name('termsAndPrivacyAndFaqs');

















Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('key:generate');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    return response()->json(['status' => 'success', 'code' => 1000000000]);
});
