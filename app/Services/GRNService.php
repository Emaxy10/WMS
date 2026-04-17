<?php

namespace App\Services;

use App\Models\GRN;
use App\Models\Inventory;
use App\Models\StockMovement;
use App\Models\PurchaseOrder;
use App\Models\PutAway;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GRNService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createGrnWithPutAway($data)
    {
        DB::beginTransaction();

        try {
            // 🔥 GET PO
            $po = PurchaseOrder::findOrFail($data['purchase_order_id']);

             // Check existing GRN
            if (GRN::where('purchase_order_id', $po->id)->exists()) {
                throw new \Exception('GRN already exists for this PO');
            }

            // CREATE GRN
            $grn = GRN::create([
                'grn_number' => GRN::generateGrnNumber(),
                'purchase_order_id' => $po->id,
                'quantity_received' => $data['quantity_received'],
                'quantity_rejected' => $data['quantity_rejected'],
                'received_date' => $data['received_date'],
                'received_by' => $data['received_by'],
                'remarks' => $data['remarks'],
            ]);

            // 🔥 CREATE STOCK MOVEMENT
            StockMovement::create([
                'product_id' => $po->product_id,
                'warehouse_id' => $po->warehouse_id,
                'quantity' => $data['quantity_received'] - $data['quantity_rejected'],
                'type' => 'IN',
                'reason' => 'GRN Creation',
                'user_id' => Auth::id(),
            ]);

            // 🔥 CREATE PUT AWAY
            PutAway::create([
                'grn_id' => $grn->id,
                'product_id' => $po->product_id,
                'warehouse_id' => $po->warehouse_id,
                'user_id' => null,
                'quantity' => $data['quantity_received'] - $data['quantity_rejected'],
                'status' => 'PENDING',
            ]);

            DB::commit();

            return $grn;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }
}
