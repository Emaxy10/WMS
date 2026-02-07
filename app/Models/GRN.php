<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    /** @use HasFactory<\Database\Factories\GRNFactory> */
    use HasFactory;

    protected $table = 'grn';

    protected $fillable = [
        'grn_number',
        'purchase_order_id',
        'quantity_received',
        'quantity_rejected',
        'received_date',
        'received_by',
        'remarks',
    ];
}
