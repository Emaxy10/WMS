<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WareHouse;
use App\Http\Requests\CreateWareHouseRequest;
use Illuminate\Support\Facades\Auth;

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

    public function showWarehouseUsers()
    {
       //get authenticated user
       $user = auth()->user();

       //get authenticated user warehouse
       $warehouse = $user->warehouse;
       return response()->json($warehouse->users);
    }
}
