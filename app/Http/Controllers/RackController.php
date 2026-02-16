<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRackRequest;
use App\Http\Requests\UpdateRackRequest;
use App\Models\Rack;
use App\Models\Zone;

class RackController extends Controller
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
    public function store(StoreRackRequest $request)
    {
        //
        try{
                $zone = Zone::findOrFail($request->zone_id);
                $total_racks = $zone->racks()->count();
                if ($total_racks >= 20) {
                    throw new \Exception('Zone has reached maximum rack capacity');
                }

                if($total_racks >= 0){
                    $last_rack_number = $total_racks +1;
                } else {
                    $last_rack_number = 1;
                }

                 $rack = Rack::create([
                    'code' => $zone->code . '-RK-' . str_pad($last_rack_number, 3, '0', STR_PAD_LEFT),
                    'description' => $request->description,
                    'zone_id' => $request->zone_id,
                    'capacity_weight' => $request->capacity_weight,
                    'current_load' => $request->current_load,
                    'number_of_levels' => $request->number_of_levels,
                ]);
                return response()->json($rack, 201);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to create rack', 'message' => $e->getMessage()], 500);
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Rack $rack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rack $rack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRackRequest $request, Rack $rack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rack $rack)
    {
        //
    }
}
