<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePutAwayRequest;
use App\Http\Requests\UpdatePutAwayRequest;
use App\Models\PutAway;

class PutAwayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //get put away list with warehouse and product details
        $putAways = PutAway::with(['warehouse', 'product', 'grn'])->get();
        return response()->json([
            'message' => 'PutAway list retrieved successfully',
            'data' => $putAways
        ], 200);
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
    public function store(StorePutAwayRequest $request)
    {
        //

        $validatedData = $request->validated();
        $putAway = PutAway::create($validatedData);
        return response()->json([
            'message' => 'PutAway created successfully',
            'data' => $putAway
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(PutAway $putAway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PutAway $putAway)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePutAwayRequest $request, PutAway $putAway)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PutAway $putAway)
    {
        //
    }
}
