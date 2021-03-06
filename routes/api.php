<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\salecontroller;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/customers', [CustomerController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/customers/{customer}', [CustomerController::class, 'getCustomer']);
    Route::post('/customers', [CustomerController::class, 'createCustomer']);
    Route::put('/customers/{customer}', [CustomerController::class, 'updateCustomer']);
    Route::delete('/customers/{customer}', [CustomerController::class, 'deleteCustomer']);
    Route::get('/sales', [salecontroller::class, 'index']);
    Route::post('/sales', [salecontroller::class, 'store']);
    Route::resource('products', ProductController::class);
});
