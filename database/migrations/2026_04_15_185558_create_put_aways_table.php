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
    Schema::create('put_aways', function (Blueprint $table) {
        $table->id();

        $table->foreignId('grn_id')->constrained('grn')->onDelete('cascade');
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
        $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        $table->integer('quantity');
        $table->enum('status', ['pending', 'completed'])->default('pending');

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('put_aways');
    }
};
