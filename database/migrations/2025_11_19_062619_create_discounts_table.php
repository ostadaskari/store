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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('type', ['percent','amount'])->default('percent');
            $table->decimal('value', 12, 2)->default(0); // percent or amount
            $table->decimal('min_order_amount', 14, 2)->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('expire_at')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->unsignedBigInteger('max_uses')->nullable();
            $table->unsignedBigInteger('uses_count')->default(0);
            $table->unsignedInteger('per_user_limit')->nullable();
            $table->json('applicable_products')->nullable();   // array of part_numbers (or ids)
            $table->json('applicable_categories')->nullable(); // array of category ids
            $table->boolean('stackable')->default(false);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });

        // optional index for code lookups
        Schema::table('discounts', function (Blueprint $table) {
            $table->index('code');
            $table->index('status');
            $table->index('expire_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
