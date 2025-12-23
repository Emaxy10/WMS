<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('product/create', [ProductController::class, 'store']);
Route::get('products', [ProductController::class, 'index']);
Route::get('product/{product}', [ProductController::class, 'show']);
Route::put('product/{product}', [ProductController::class, 'update']);
Route::delete('product/{product}', [ProductController::class, 'destroy']);