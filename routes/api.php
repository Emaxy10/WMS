<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\WareHouseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Http\Request;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\ClientController;



Route::get('sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'CSRF cookie set']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

Route::post('users/create', [UserController::class, 'store']);

Route::post('product/create', [ProductController::class, 'store']);
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::put('products/{product}', [ProductController::class, 'update']);
Route::delete('products/{product}', [ProductController::class, 'destroy']);

//Purchase Order routes
Route::post('purchase-order/create', [PurchaseOrderController::class, 'store']);
Route::get('purchase-orders', [PurchaseOrderController::class, 'index']);
Route::get('purchase-orders/{purchaseOrder}', [PurchaseOrderController::class, 'show']);
Route::put('purchase-orders/{purchaseOrder}', [PurchaseOrderController::class, 'update']);
Route::delete('purchase-orders/{purchaseOrder}', [PurchaseOrderController::class, 'destroy']);
//Route::get('purchase-orders/{purchaseOrder}/grn', [PurchaseOrderController::class, 'getGrn']);
Route::get('purchase-orders/{purchaseOrder}/download-file', [PurchaseOrderController::class, 'downloadFile']);
Route::put('purchase-orders/{purchaseOrder}/approve', [PurchaseOrderController::class, 'approve']);

//GRN routes
Route::post('grn/create', [GRNController::class, 'store']);

//Zone routes
Route::post('zone/create', [ZoneController::class, 'store']);

//Rack routes
Route::post('rack/create', [RackController::class, 'store']);



//stock movement routes
Route::post('stock-movement/create', [StockMovementController::class, 'store'])
->middleware('auth:sanctum');
Route::get('stock-movements', [StockMovementController::class, 'index']);


Route::post('warehouse/create', [WareHouseController::class, 'store']);
Route::get('warehouses', [WareHouseController::class, 'index']);
Route::post('inventory/create', [InventoryController::class, 'store']);

Route::post('user/create', [UserController::class, 'store']);

//Client routes
Route::post('client/create', [ClientController::class, 'store']);
Route::get('clients', [ClientController::class, 'index']);
Route::get('clients/{client}', [ClientController::class, 'show']);