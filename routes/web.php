<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

// Route::get('user/{id}', [UserController::class, 'store'])->name('seller.create');
Route::resource('user', UserController::class);
Route::resource('manage-product', ProductController::class);
Route::get('addproduct/{id}', [ProductController::class, 'addproduct']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/alamat', [AlamatController::class, 'index']);
Route::get('/rekening', [RekeningController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);