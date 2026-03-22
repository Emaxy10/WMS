<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Client;
use App\Models\WareHouse;
use App\Models\GRN;
use Illuminate\Support\Str;

class PurchaseOrder extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseOrderFactory> */
    use HasFactory;

    protected $fillable = [

        'product_id',
        'client_id',
        'warehouse_id',
        'quantity_ordered',
        // 'quantity_received',
        'status',
        'order_date',
        'expected_delivery_date',
        'unit_of_measure',
        'file_path',
        'code',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function grn()
    {
        return $this->hasOne(GRN::class);
    }

     public static function generatePurchaseOrderCode()
    {
       do {
            $order_code = 'PO-' . strtoupper(Str::random(4));
        } while (self::where('code', $order_code)->exists());
        return $order_code;
    }

    
}
