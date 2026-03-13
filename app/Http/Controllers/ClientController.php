<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $clients = Client::all();
            return response()->json($clients);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve clients', 'message' => $e->getMessage()], 500);
        }
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
    public function store(StoreClientRequest $request)
    {
        //
        try {
             $validatedData = $request->validated();
            $validatedData['code'] = Client::generateClientCode();
            Client::create($validatedData); 
            return response()->json(['message' => 'Client created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create client', 'message' => $e->getMessage()], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        try {
            return response()->json($client);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve client', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
