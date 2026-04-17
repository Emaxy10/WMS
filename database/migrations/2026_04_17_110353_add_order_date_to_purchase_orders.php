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
        Schema::table('purchase_orders', function (Blueprint $table) {
            //
                $table->date('order_date')->after('status')->nullable();
                $table->date('expected_delivery_date')->after('order_date')->nullable();
                $table->string('unit_of_measure')->after('expected_delivery_date')->nullable();
                $table->string('file_path')->after('unit_of_measure')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            //
        });
    }
};
