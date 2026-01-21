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
        Schema::table('products', function (Blueprint $table) {
            //
            $table->unsignedInteger('average_daily_sales')->after('category');
            $table->unsignedInteger('supplier_lead_time')->after('average_daily_sales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
             $table->dropColumn([
                'average_daily_sales',
                'supplier_lead_time',
            ]);
        });
    }
};
