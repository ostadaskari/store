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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 50)->unique()->nullable();
            $table->string('transaction_id', 255)->unique()->nullable();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // --- Address Linking ---

            $table->foreignId('user_address_id')->nullable()->constrained('user_addresses')->onDelete('set null');


            // Shipping & Discount
            $table->foreignId('shipping_id')->nullable()->constrained('shippings');
            $table->string('discount_code')->nullable();
            $table->unsignedBigInteger('discount_amount')->default(0);
            $table->unsignedBigInteger('shipping_amount')->default(0);

            // Financial & Payment
            $table->unsignedBigInteger('total_amount'); // Final total paid by user
            $table->string('payment_method'); // 'credit' (online) or 'cash' (COD)

            // Statuses
            $table->string('status')->default('pending'); // 'pending', 'processing', 'completed', 'canceled'
            $table->boolean('is_delete')->default(false);
            $table->boolean('is_payment')->default(false);
            $table->json('payment_data')->nullable(); // Store gateway response data
            $table->text('note')->nullable(); // Order note specific to this address/delivery
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
