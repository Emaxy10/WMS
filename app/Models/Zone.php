<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //

    protected $fillable = [
        
        'description',
        'warehouse_id',
        'type',
        'temperature_controlled',
        'restricted_access',
        'code',

    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }


  
}
