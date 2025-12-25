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
        Schema::table('order_items', function (Blueprint $table) {
            // Add discount_percent to record the discount applied at the time of order
            $table->decimal('discount_percent', 5, 2)->default(0)->after('quantity');
            // Note: 'price' should be the original price before discount
            // 'total_price' will be (price * (1 - discount/100)) * quantity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('discount_percent');
        });
    }
};
