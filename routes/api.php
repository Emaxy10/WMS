<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\WareHouseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

Route::get('sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'CSRF cookie set']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

Route::post('product/create', [ProductController::class, 'store']);
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::put('products/{product}', [ProductController::class, 'update']);
Route::delete('products/{product}', [ProductController::class, 'destroy']);

Route::post('stock-movement/create', [StockMovementController::class, 'store']);


Route::post('warehouse/create', [WareHouseController::class, 'store']);
Route::post('inventory/create', [InventoryController::class, 'store']);

Route::post('user/create', [UserController::class, 'store']);