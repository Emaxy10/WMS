<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateStockMovementRequest;
use App\Models\StockMovement;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class StockMovementController extends Controller
{
    //
    public function store(CreateStockMovementRequest $request)
    {
        //
         $inventory = Inventory::where('product_id', $request->product_id)
            ->where('warehouse_id', $request->warehouse_id)
         ->firstOrFail();

         //dd(Auth::id(), Auth::check());



        if($inventory->quantity < $request->input('quantity') && $request->input('type') === 'out'){
            return response()->json([
                'message' => 'Insufficient stock for this movement'
            ], 400);
        }
        $stockMovement = StockMovement::create([
            'user_id' => Auth::id(),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'warehouse_id' => $request->input('warehouse_id'),
            'type' => $request->input('type'),
            'reason' => $request->input('reason'),
        ]);
        //return response()->json($stockMovement, 201);

           //update inventory
            Inventory::updateInventory(
             $request->product_id,
             $request->quantity, 
             $request->type, 
             $request->location
            );
            return response()->json([
                'message' => 'Stock movement recorded and inventory updated successfully'
            ], 201);

        
    }

    public function index()
    {
        //
        $stockMovements = StockMovement::with('product', 'user', 'warehouse')->get();
        return response()->json($stockMovements, 200);
    }
}
