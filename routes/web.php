<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageOrderController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\LinkGrabCurlController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// REGISTER
Route::get('register/user', [RegisterController::class, 'registerUser'])->name('formRegister.user');
Route::get('register/customer', [RegisterController::class, 'registerCustomer'])->name('formRegister.customer');
Route::post('register/user', [RegisterController::class, 'registerUser'])->name('register.user');
Route::post('register/customer', [RegisterController::class, 'registerCustomer'])->name('register.customer');

// Login Customer
Route::get('login/customer', [AuthController::class, 'index'])->name('login_customer');
Route::post('do_login_customer', [AuthController::class, 'login'])->name('do_login_customer');
Route::post('do_logout_customer', [AuthController::class, 'logout'])->name('do_logout_customer');

Route::get('grabbingProduct', [LinkGrabCurlController::class, 'grabbingProduct']);
Route::get('grabbingProduct2', [LinkGrabCurlController::class, 'grabbingProduct2']);

// Buyer Controller
Route::post('/deleteOrder', [BuyerController::class, 'deleteOrder'])->name('deleteOrder.verivikasi');
Route::post('/user/{id}', [BuyerController::class, 'verivikasiPassword'])->name('verivikasi.password');
Route::post('suggestion/{id}', [BuyerController::class, 'suggestion'])->name('create.suggestion');
Route::post('/addtocartajax', [BuyerController::class, 'ajaxaddtocart']);
Route::get('capps', [BuyerController::class, 'cariToko'])->name('filter.toko');
Route::get('scan', [BuyerController::class, 'finishOrder'])->name('order.finish');
Route::get('lowongan-pekerjaan/{id}', [BuyerController::class, 'job'])->name('buyer.job');
Route::get('scan-qr', [BuyerController::class, 'qrGenerator'])->name('order.qrcode');
Route::resource('cart', BuyerController::class);
Route::post('keranjang', [BuyerController::class, 'cart'])->name('cart.buyer');

Auth::routes();
// CUSTOMER
Route::post('customer/account/hapus-alamat/{id}', [CustomerController::class, 'hapusAlamatCustomer'])->name('hapusAlamatCustomer');
Route::post('customer/account/tambah-alamat', [CustomerController::class, 'alamatCustomer'])->name('alamatCustomer');
Route::get('customer/account/alamat', [CustomerController::class, 'formalamatCustomer'])->name('formalamatCustomer');
Route::get('customer/account', [CustomerController::class, 'accountCustomer'])->name('accountCustomer');
Route::get('customer/pesanan', [CustomerController::class, 'pesananSaya'])->name('pesanan.saya');
Route::any('/customer/sell', [CustomerController::class, 'sellCustomer'])->name('sellCustomer');
Route::post('/addtocartcustomer', [CustomerController::class, 'addToKeranjang']);
Route::resource('customer', CustomerController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Dashboard Controller
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Product Controller
Route::post('manage-product/import', [ProductController::class, 'importProduct'])->name('product.import');
Route::get('manage-product/importform', [ProductController::class, 'importform'])->name('manage-product.import');;
Route::post('manage-product/botMigrasiUpload', [ProductController::class, 'botMigrasiUpload']);
Route::get('manage-product/creates', [ProductController::class, 'create']);
Route::get('/product', [ProductController::class, 'index']);
Route::resource('manage-product', ProductController::class);

// Manage Order Controller
Route::post('manage-order/verivikasidelete/{id}', [ManageOrderController::class, 'deleteOrder'])->name('verivikasi.delete');
Route::post('manage-order/verivikasipesanan', [ManageOrderController::class, 'verivikasiOrder'])->name('verivikasi.pesanan');
Route::post('manage-order/verivikasiByGet', [ManageOrderController::class, 'verivikasiByGet'])->name('verivikasi.byGet');
Route::get('manage-order/verivikasi', [ManageOrderController::class, 'formVerivikasiOrder'])->name('verivikasi.order');
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

// Job Controller
Route::post('manage-job/{id}', [JobController::class, 'ubahStatus'])->name('job.status');
Route::resource('manage-job', JobController::class);
