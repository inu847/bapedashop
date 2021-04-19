<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageOrderController;
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
Route::get('/test/1/1', function () {
    return view('test');
});


Route::resource('user', UserController::class);
Route::resource('cart', ChartController::class);
Route::post('/user/{id}', [UserController::class, 'verivikasiPassword'])->name('verivikasi.password');

Auth::routes();

Route::resource('manage-product', ProductController::class);
Route::resource('manage-order', ManageOrderController::class);
Route::post('status/{id}', [ManageOrderController::class, 'status'])->name('tools.status');
Route::resource('tools', ToolsController::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/alamat', [AlamatController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/member', [ToolsController::class, 'member'])->name('tools.member');
Route::get('/superMember', [ToolsController::class, 'superMember'])->name('tools.superMember');
Route::post('/addtocartajax', [ChartController::class, 'ajaxaddtocart']);
Route::post('/actionled', [ToolsController::class, 'actionled']);
