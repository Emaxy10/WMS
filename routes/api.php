<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\WareHouseController;

Route::post('product/create', [ProductController::class, 'store']);
Route::get('products', [ProductController::class, 'index']);
Route::get('product/{product}', [ProductController::class, 'show']);
Route::put('product/{product}', [ProductController::class, 'update']);
Route::delete('product/{product}', [ProductController::class, 'destroy']);

Route::post('stock-movement/create', [StockMovementController::class, 'store']);


Route::post('warehouse/create', [WareHouseController::class, 'store']);
Route::post('inventory/create', [InventoryController::class, 'store']);