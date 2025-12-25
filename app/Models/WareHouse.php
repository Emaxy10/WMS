<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    //
    protected $fillable = [
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
}
