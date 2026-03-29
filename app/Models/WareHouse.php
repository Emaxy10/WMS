<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WareHouse extends Model
{
    //


    protected $table = 'warehouses';

    protected $fillable = [
        'code',
        'name',
        'location',
        'manager',
        'address'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'location', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'location', 'id');
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function users(){
        return $this->hasMany(User::class, 'warehouse_id');
    }

 public static function generateWarehouseCode()
    {
       do {
            $code= 'WH-' . strtoupper(Str::random(4));
        } while (self::where('code', $code)->exists());
        return $code;
    }
}
