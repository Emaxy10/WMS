<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use Illuminate\Support\Facades\Storage;
//use App\Models\Warehouse;

use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            return response()->json(PurchaseOrder::with(['product', 'client', 'warehouse'])->get());
        }
        catch(\Exception $e){
             return response()->json(['error' => 'Failed to getpurchase orders', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseOrderRequest $request)
    {
        //
        try {
            $path = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                //create random folder name using current timestamp and random string
                //keep the original file name

                $folderName = time() . '_' . uniqid();
                $path = $file->storeAs('purchase_orders/' . $folderName, $file->getClientOriginalName()); 

            }
        $data = PurchaseOrder::create([
                'product_id' => $request->product_id,
                'client_id' => $request->client_id,
                'warehouse_id' => $request->warehouse_id,
                'quantity_ordered' => $request->quantity_ordered,
                // 'quantity_received' => 0, // Initialize quantity received to 0
                'status' => 'pending', // Default status
                'order_date' => now(),
                'expected_delivery_date' => $request->expected_delivery_date,
                'unit_of_measure' => $request->unit_of_measure,
                'file_path' => $path,
            ]);

            return response()->json($data, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create purchase order', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
        return response()->json($purchaseOrder->load(['product', 'client', 'warehouse', 'grn']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    //download file
    public function downloadFile(PurchaseOrder $purchaseOrder)
    {
        try{
            if (!$purchaseOrder->file_path || !Storage::exists($purchaseOrder->file_path)) {
                

                return response()->json(['error' => 'File not found'], 404);
            }
             //dd($purchaseOrder->file_path); 
    
            return Storage::download($purchaseOrder->file_path);
        }
        catch(\Exception $e){
             return response()->json(['error' => 'Failed to download file', 'message' => $e->getMessage()], 500);
        }
    }
}
