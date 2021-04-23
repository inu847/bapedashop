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
Route::get('scan-qr', [ChartController::class, 'qrGenerator'])->name('order.qrcode');
Route::get('scan', [ChartController::class, 'finishOrder'])->name('order.finish');
Route::resource('cart', ChartController::class);
Route::post('/user/{id}', [UserController::class, 'verivikasiPassword'])->name('verivikasi.password');


Route::post('logged_in', [LoginController::class, 'authenticate']);
Auth::routes();

Route::resource('manage-product', ProductController::class);
Route::post('manage-order/verivikasi', [ManageOrderController::class, 'verivikasiOrder'])->name('verivikasi.pesanan');
Route::get('manage-order/verivikasi', [ManageOrderController::class, 'formVerivikasiOrder'])->name('verivikasi.order');
Route::resource('manage-order', ManageOrderController::class);
Route::post('status/{id}', [ManageOrderController::class, 'status'])->name('tools.status');
Route::resource('tools', ToolsController::class);
Route::get('setting/alamat', [UserController::class, 'showAlamat'])->name('setting.alamat');
Route::post('setting/alamat', [UserController::class, 'alamat'])->name('add.alamat');
Route::post('setting/alamat/{id}', [UserController::class, 'hapusAlamat'])->name('alamat.destroy');

// Route::get('tools/pricing', ToolsController::class)->name('tools.pricing');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/alamat', [AlamatController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/member', [ToolsController::class, 'member'])->name('tools.member');
Route::get('/superMember', [ToolsController::class, 'superMember'])->name('tools.superMember');
Route::post('/addtocartajax', [ChartController::class, 'ajaxaddtocart']);
Route::post('/actionled', [ToolsController::class, 'actionled']);
