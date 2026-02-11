<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    
}
