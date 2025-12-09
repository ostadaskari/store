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

            // Foreign Key to the 'orders' table (in the current DB) - This is correct
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            // **CHANGE HERE: Removed foreign key constraint**
            // Since 'products' table is in a different database/connection ('warehouse'),
            // we cannot use Eloquent's `constrained()`. We keep it as a simple column.
            $table->unsignedBigInteger('product_id');

            $table->integer('quantity');
            $table->unsignedBigInteger('price'); // Price per unit at the time of order
            $table->unsignedBigInteger('total_price'); // quantity * price

            $table->timestamps();

            // Unique index based on the two IDs
            $table->unique(['order_id', 'product_id']);
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
