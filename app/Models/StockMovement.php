<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    //
    protected $fillable = [
        'product_id',
        'quantity',
        'location',
        'type',
        'reason',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(WareHouse::class, 'warehouse_id');
    }
}
