<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //

         Schema::table('purchase_orders', function (Blueprint $table) {
            // add new columns


            // remove columns
            $table->dropColumn('supplier_id');
            $table->dropColumn('quantity_received');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //

          Schema::table('purchase_orders', function (Blueprint $table) {
            // rollback added columns
            $table->dropColumn('client_id');
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');


            // rollback removed columns
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->integer('quantity_received')->default(0);
        });
    }
};
