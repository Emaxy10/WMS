<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    /** @use HasFactory<\Database\Factories\RackFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'zone_id',
        'number_of_levels',
        'warehouse_id',
        'capacity',
        'current_load',
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
