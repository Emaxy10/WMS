<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGRNRequest;
use App\Http\Requests\UpdateGRNRequest;

use App\Models\Inventory;
use App\Models\GRN;

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGRNRequest $request)
    {
        //

        try {
            //$data = $request->validated();
            $grn = GRN::create([
                'grn_number' => $request->input('grn_number'),
                'purchase_order_id' => $request->input('purchase_order_id'),
                'quantity_received' => $request->input('quantity_received'),
                'quantity_rejected' => $request->input('quantity_rejected'),
                'received_date' => $request->input('received_date'),
                'received_by' => $request->input('received_by'),
                'remarks' => $request->input('remarks'),
            ]);

            //Stock movement happens when GRN is approved
            return response()->json($grn, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create GRN', 'message' => $e->getMessage()], 500);
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
