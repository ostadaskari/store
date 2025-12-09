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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();

            // Foreign key to link the address to the user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Receiver Information
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('mobile', 15);
            $table->string('email', 150)->nullable();
            $table->string('phone', 15)->nullable(); // Optional fixed phone

            // Location Details
            $table->string('province', 50);
            $table->string('city', 50);
            $table->string('address', 500); // Full street address details
            $table->string('plate', 10); // Plaque number
            $table->string('post_code', 10); // Postal code

            // Optional/Other Details
            $table->string('company_name', 100)->nullable();


            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
