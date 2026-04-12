<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = [
        'product_id',
        'quantity',
        'location',
        'warehouse_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    //Static method to update inventory
    // public static function updateInventory($product_id, $quantity, $type, $location){
    //     try{
    //     $inventory = self::where('product_id', $product_id)
    //     ->where('warehouse_id', $location)
    //     ->first();
    //     if ($inventory) {
    //         if ($type === 'in') {
    //             $inventory->quantity += $quantity;
    //         } elseif ($type === 'out') {
    //             $inventory->quantity -= $quantity;
    //         }
    //         $inventory->save();
    //     }
    //      } catch (\Exception $e){
    //     //Log error or handle accordingly
    //     throw new \Exception("Failed to update inventory: " . $e->getMessage());
    //      }
    // }


public static function updateInventory($product_id, $quantity, $type, $warehouse_id)
{
    try {

        // 🔍 Find existing inventory
        $inventory = self::where('product_id', $product_id)
            ->where('warehouse_id', $warehouse_id)
            ->first();

        // 🆕 CREATE if not exists
        if (!$inventory) {
            $inventory = self::create([
                'product_id' => $product_id,
                'warehouse_id' => $warehouse_id,
                'quantity' => 0,
                'location' => 'DEFAULT'
            ]);
        }

        // 🔄 Update quantity
        if ($type === 'in') {
            $inventory->quantity += (int) $quantity;
        } elseif ($type === 'out') {

            // ❗ Prevent negative stock
            if ($inventory->quantity < $quantity) {
                throw new \Exception("Insufficient stock");
            }

            $inventory->quantity -= (int) $quantity;
        }

        $inventory->save();

    } catch (\Exception $e) {
        throw new \Exception("Failed to update inventory: " . $e->getMessage());
    }
}


    public function warehouse()
    {
        return $this->belongsTo(WareHouse::class, 'warehouse_id');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'product_id', 'product_id');
    }
}