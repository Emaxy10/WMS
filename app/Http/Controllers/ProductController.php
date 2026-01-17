<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        //
        $product = Product::create([
            'code' => Product::generateProductCode(),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'reorder_level' => $request->input('reorder_level'),
            'safety_stock' => $request->input('safety_stock'),
            'unit' => $request->input('unit'),
        ]);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        // get warehouses associated with this product
        $warehouses = $product->inventory()->with('warehouse')->get();

        // Get inventories with their warehouses
        $inventories = $product->inventory()->with('warehouse')->get();

        //Extract only the warehouse objects + Produt quantities in inventories
        $product->warehouses = $inventories->map(function($inventory){
            $inventory->warehouse->quantity = $inventory->quantity;
            
            return $inventory->warehouse;
        });
         

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        $product->update($request->validated());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return response()->json(null, 204);
    }
}
