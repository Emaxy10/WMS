<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PutAway extends Model
{
    /** @use HasFactory<\Database\Factories\PutAwayFactory> */
    use HasFactory;

    protected $fillable = [
        'grn_id',
        'product_id',
        'warehouse_id',
        'user_id',
        'quantity',
        'status',
    ];


    public function grn()
    {
        return $this->belongsTo(Grn::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
