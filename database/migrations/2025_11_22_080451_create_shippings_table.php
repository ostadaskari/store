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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191);                          // e.g. "ارسال با پست"
            $table->string('slug', 191)->unique();                // e.g. "post"
            $table->unsignedBigInteger('price')->default(0);      // price in toman (integer)
            $table->string('delivery_time')->nullable();                // human readable e.g. "2-7 روز"
            $table->decimal('min_weight', 8, 2)->nullable();// optional weight limits
            $table->decimal('max_weight', 8, 2)->nullable();
            $table->boolean('status')->default(true);             // active / inactive
            $table->boolean('is_deleted')->default(false);        // soft-like delete
            $table->unsignedInteger('sort_order')->default(100);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
