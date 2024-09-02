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


Route::get('/', function () {
    return view('user/index');
})->name('main.index');
#==================================auth========================
Route::get('login', [MainController::class, 'ShowLoginForm'])->name('main.login');
Route::post('login', [MainController::class, 'login'])->name('login');


Route::get('register', [MainController::class, 'showRegisterForm'])->name('main.register');
Route::post('register', [MainController::class, 'registerNewCustomer'])->name('registerNewCustomer');

Route::get('logout', [MainController::class, 'logout'])->name('logout');


















Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('key:generate');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    return response()->json(['status' => 'success', 'code' => 1000000000]);
});
