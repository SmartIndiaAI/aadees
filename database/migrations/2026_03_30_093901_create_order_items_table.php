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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
            $table->decimal('shipping_charge', 15, 2)->default(0);
            $table->decimal('admin_share', 15, 2)->default(0);
            $table->decimal('vendor_share', 15, 2)->default(0);
            $table->string('transfer_reference_id')->unique()->nullable(); // Unique for idempotency
            $table->boolean('is_transfer_processed')->default(false); // Prevents duplicates
            $table->string('status')->default('pending'); // pending, processing, shipped, delivered, cancelled, returned
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
