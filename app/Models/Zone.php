<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //

    protected $fillable = [
        'code',
        'description',
        'ware_house_id',
        'type',
        'temperature_controlled',
        'restricted_access',

    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }


  
}
