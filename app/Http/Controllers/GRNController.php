<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGRNRequest;
use App\Http\Requests\UpdateGRNRequest;

// use App\Models\Inventory;
// use App\Models\GRN;
// use App\Models\StockMovement;
// use App\Models\PurchaseOrder;

use App\Services\GRNService;
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
        $grnService = new GRNService();
        try {
            $grn = $grnService->createGrnWithPutAway($request->validated());
            return response()->json([
                'message' => 'GRN created successfully',
                'data' => $grn
            ], 201);
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
