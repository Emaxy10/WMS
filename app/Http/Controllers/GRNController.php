<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGRNRequest;
use App\Http\Requests\UpdateGRNRequest;

use App\Models\Inventory;
use App\Models\GRN;
use App\Models\StockMovement;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GRNController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



public function store(StoreGRNRequest $request)
{
    try {

        $existingGrn = GRN::where('purchase_order_id', $request->input('purchase_order_id'))->first();

        if ($existingGrn) {
            return response()->json(['error' => 'A GRN already exists for this purchase order.'], 400);
        }

        // 🔥 GET PO
        $po = PurchaseOrder::findOrFail($request->input('purchase_order_id'));

        // CREATE GRN
        $grn = GRN::create([
            'grn_number' => GRN::generateGrnNumber(),
            'purchase_order_id' => $po->id,
            'quantity_received' => $request->input('quantity_received'),
            'quantity_rejected' => $request->input('quantity_rejected'),
            'received_date' => $request->input('received_date'),
            'received_by' => $request->input('received_by'),
            'remarks' => $request->input('remarks'),
        ]);

        // 🔥 CREATE STOCK MOVEMENT
        StockMovement::create([
            'product_id' => $po->product_id,
            'purchase_order_id' => $po->id,
            'quantity' => $request->input('quantity_received'),
            'warehouse_id' => $po->warehouse_id,
            'type' => 'in',
            'reason' => 'GRN created for PO: ' . $po->id,
        ]);


         //update inventory
            Inventory::updateInventory(
             $po->product_id,
             $request->input('quantity_received'),
             'in',
            $po->warehouse_id
            );

        return response()->json($grn, 201);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Failed to create GRN',
            'message' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(GRN $gRN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GRN $gRN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGRNRequest $request, GRN $gRN)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GRN $gRN)
    {
        //
    }
}
