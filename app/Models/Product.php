<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    //
    protected $fillable = [
        'code',
        'name',
        'description',
        'category',
        'reorder_level',
        'safety_stock',
        'unit',
    ];

    public static function generateProductCode(){
         do {
        $code = 'PRD-' . strtoupper(Str::random(4));
        } while (self::where('code', $code)->exists());

        return $code;
    }

//     ✅ Auto-Generate on Create (Even Better)

// If you never want controllers to worry about this, use a model event.

//     protected static function booted()
// {
//     static::creating(function ($product) {
//         if (empty($product->code)) {
//             $product->code = self::generateProductCode();
//         }
//     });
// }


 public function inventory(){
    return $this->hasMany(Inventory::class, 'product_id', 'id');
    }

}