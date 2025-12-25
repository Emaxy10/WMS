<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Http\Requests\CreateInventoryRequest;

class InventoryController extends Controller
{
    //
    public function index()
    {
        //
    }

    public function store(CreateInventoryRequest $request)
    {
        //
        $data = $request->validated();
        $inventory = Inventory::create($data);
        return response()->json($inventory, 201);
    }

}
