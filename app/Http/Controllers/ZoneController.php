<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateZoneRequest;
use App\Models\Zone;

class ZoneController extends Controller
{
    //
    public function store(CreateZoneRequest $request)
    {
        try{
            $zone = Zone::create($request->validated());
            return response()->json($zone, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create zone', 'message' => $e->getMessage()], 500);
        }
       
    }
}
