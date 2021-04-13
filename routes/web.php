<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ToolsController;

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
    return view('welcome');
});
Route::get('/test', function () {
    return view('layouts.global');
});

Route::resource('user', UserController::class);
Route::resource('cart', ChartController::class);
// Route::post('cart/{id}', [ChartController::class, 'cart'])->name('addcart');

Route::post('/user/{id}', [UserController::class, 'verivikasiPassword'])->name('verivikasi.password');

Auth::routes();
Route::resource('manage-product', ProductController::class);
Route::resource('tools', ToolsController::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/alamat', [AlamatController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
