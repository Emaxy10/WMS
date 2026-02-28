<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBinRequest;
use App\Http\Requests\UpdateBinRequest;
use App\Models\Bin;

class BinController extends Controller
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
    public function store(StoreBinRequest $request)
    {
        //

            try {
                    $rack = Rack::findOrFail($request->rack_id);
                    $total_bins = $rack->bins()->count();
                    if ($total_bins >= 50) {
                        throw new \Exception('Rack has reached maximum bin capacity');
                    }

                    if($total_bins >= 0){
                        $last_bin_number = $total_bins +1;
                    } else {
                        $last_bin_number = 1;
                    }

                $bin = Bin::create([
                    'code' => $rack->code . '-BIN-' . str_pad($last_bin_number, 2, '0', STR_PAD_LEFT),
                    'description' => $request->description,
                    'rack_id' => $request->rack_id,
                    'capacity' => $request->capacity,
                    'level' => $request->level,
                ]);
                return response()->json($bin, 201);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to create bin', 'message' => $e->getMessage()], 500);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bin $bin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bin $bin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBinRequest $request, Bin $bin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bin $bin)
    {
        //
    }
}
