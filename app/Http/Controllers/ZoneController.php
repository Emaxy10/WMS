<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateZoneRequest;
use App\Models\Zone;
use App\Models\WareHouse;

class ZoneController extends Controller
{
    //
    public function store(CreateZoneRequest $request)
    {
        try{
            $warehouse = Warehouse::findOrFail($request->warehouse_id);
            
            $total_zones = $warehouse->zones()->count();
           // dd($total_zones);
            if ($total_zones >= 10) {
                 throw new \Exception('Warehouse has reached maximum zone capacity');
            }

            if($total_zones >= 0){
                $last_zone_number = $total_zones +1;
            } else {
                $new_zone_number = 1;
            }
            $zone = Zone::create([
                'description' => $request->description,
                'warehouse_id' => $request->warehouse_id,
                'type' => $request->type,
                'temperature_controlled' => $request->temperature_controlled,
                'restricted_access' => $request->restricted_access,
                'code' => $warehouse->code . '-ZN-' . str_pad($last_zone_number, 3, '0', STR_PAD_LEFT),
            ]);

           // dd($zone);
            
            return response()->json($zone, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create zone', 'message' => $e->getMessage()], 500);
        }
       
    }

    public function index()
    {
        //with racks and bins
        $zones = Zone::with('racks.bins')->get();
        return response()->json($zones);
    }
}
