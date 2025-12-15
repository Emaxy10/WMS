<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'code',
        'name',
        'description',
        'category',
        'quantity',
        'reorder_level',
        'safety_stock',
        'unit',
        'location',
    ];

  

}
