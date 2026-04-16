<?php
// Get the GRN model which represents the Goods Received Note in the inventory management system. This model will be used to interact with the 'grn' table in the database, allowing us to create, read, update, and delete GRN records.
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

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
  

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function receivedBy()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public static function generateGrnNumber()
    {
       do {
            $grn_number = 'GRN-' . strtoupper(Str::random(4));
        } while (self::where('grn_number', $grn_number)->exists());
        return $grn_number;
    }

    public function putAways()
    {
        return $this->hasMany(PutAway::class);
    }

   
}
