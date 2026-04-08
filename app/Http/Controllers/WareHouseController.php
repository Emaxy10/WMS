<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WareHouse;
use App\Http\Requests\CreateWareHouseRequest;

class WareHouseController extends Controller
{
    //
    public function store(CreateWareHouseRequest $request)
    {
      try{
        $warehouse = WareHouse::create([
            'code' => WareHouse::generateWarehouseCode(),
            'name' => $request->name,
            'location' => $request->location,
            'manager_id' => $request->manager_id,
            'address' => $request->address
        ]);
        return response()->json($warehouse, 201);
      }catch(\Exception $e){
        return response()->json(['error' => 'Failed to create warehouse', 'message' => $e->getMessage()], 500);
      }

    }


    
    public function index()
    {
        $warehouses = WareHouse::all();
        return response()->json($warehouses);
    }

    public function showWarehouseUsers($id)
    {
        try {
            $warehouse = WareHouse::with('users')->findOrFail($id);
            return response()->json($warehouse->users);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to get warehouse users', 'message' => $e->getMessage()], 500);
        }
    }
}
