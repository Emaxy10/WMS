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
        return $this->belongsTo(Product::class);
    }

    //Static method to update inventory
    public static function updateInventory($product_id, $quantity, $type){
        $inventory = self::where('product_id', $product_id)->first();
        if ($inventory) {
            if ($type === 'in') {
                $inventory->quantity += $quantity;
            } elseif ($type === 'out') {
                $inventory->quantity -= $quantity;
            }
            $inventory->save();
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