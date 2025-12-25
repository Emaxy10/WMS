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
        $data = $request->validated();
        $warehouse = WareHouse::create($data);
        return response()->json($warehouse, 201);

    }
}
