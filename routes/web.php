<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuyerController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Another Login
Route::post('logged_in', [LoginController::class, 'authenticate']);

// Buyer Controller

Route::post('/user/{id}', [BuyerController::class, 'verivikasiPassword'])->name('verivikasi.password');
Route::post('suggestion/{id}', [BuyerController::class, 'suggestion'])->name('create.suggestion');
Route::post('/addtocartajax', [BuyerController::class, 'ajaxaddtocart']);
Route::get('capps', [BuyerController::class, 'cariToko'])->name('filter.toko');
Route::get('scan', [BuyerController::class, 'finishOrder'])->name('order.finish');
Route::get('scan-qr', [BuyerController::class, 'qrGenerator'])->name('order.qrcode');
Route::resource('cart', BuyerController::class);

Auth::routes();

// Dashboard Controller
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Product Controller
Route::get('/product', [ProductController::class, 'index']);
Route::resource('manage-product', ProductController::class);

// Manage Order Controller
Route::post('manage-order/verivikasi', [ManageOrderController::class, 'verivikasiOrder'])->name('verivikasi.pesanan');
Route::get('manage-order/verivikasi', [ManageOrderController::class, 'formVerivikasiOrder'])->name('verivikasi.order');
Route::get('manage-order/verivikasi-qrcode', [ManageOrderController::class, 'qrcode'])->name('verivikasi.qrcode');
Route::resource('manage-order', ManageOrderController::class);
Route::post('status/{id}', [ManageOrderController::class, 'status'])->name('tools.status');

// User Controller
Route::get('setting/alamat', [UserController::class, 'showAlamat'])->name('setting.alamat');
Route::post('setting/alamat', [UserController::class, 'alamat'])->name('add.alamat');
Route::post('setting/alamat/{id}', [UserController::class, 'hapusAlamat'])->name('alamat.destroy');
Route::resource('user', UserController::class);

// Tools Controller
Route::get('/member', [ToolsController::class, 'member'])->name('tools.member');
Route::get('/superMember', [ToolsController::class, 'superMember'])->name('tools.superMember');
Route::post('/actionled', [ToolsController::class, 'actionled']);
Route::resource('tools', ToolsController::class);
