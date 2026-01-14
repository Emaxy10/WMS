<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateStockMovementRequest;
use App\Models\StockMovement;
use App\Models\Inventory;
use App\Models\Product;

class StockMovementController extends Controller
{
    //
    public function store(CreateStockMovementRequest $request)
    {
        //
         $inventory = Inventory::where('product_id', $request->product_id)
            ->where('warehouse_id', $request->location)
         ->firstOrFail();

         if (!$inventory) {
                throw new \Exception("Inventory record not found for product_id {$product_id}");
            }

        if($inventory->quantity < $request->input('quantity') && $request->input('type') === 'out'){
            return response()->json([
                'message' => 'Insufficient stock for this movement'
            ], 400);
        }
        $stockMovement = StockMovement::create([
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'location' => $request->input('location'),
            'type' => $request->input('type'),
            'reason' => $request->input('reason'),
        ]);
        //return response()->json($stockMovement, 201);

        if(response()->json($stockMovement, 201)){
           //update inventory
           $product_id = $request->input('product_id');
           $quantity = $request->input('quantity');
            $type = $request->input('type');
            $location = $request->input('location');
            Inventory::updateInventory($product_id, $quantity, $type, $location);
            return response()->json([
                'message' => 'Stock movement recorded and inventory updated successfully'
            ], 201);

        } else {
            return response()->json([
                'message' => 'Failed to record stock movement'
            ], 500);
        }
    }
}
