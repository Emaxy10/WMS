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
    ];
}
