<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkGrabCurlController;
use App\Http\Controllers\ToolsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user', [BuyerController::class, 'getToko']);
Route::post('scanIotBarcodeGenerate/scan/withSuperAdmin/{id}', [BuyerController::class, 'scanIot']);
Route::post('login', [AuthController::class, 'login']);
Route::get('grabbingProductShopee', [LinkGrabCurlController::class, 'grabbingProduct']);
Route::get('tesapi', [ToolsController::class, 'tesapi']);
