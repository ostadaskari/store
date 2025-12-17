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
        Schema::table('users', function (Blueprint $table) {
            // Personal Info Fields
            $table->string('job', 100)->nullable()->after('email');
            $table->date('birth_date')->nullable()->after('job');

            // Bank Info Fields
            $table->string('account_number', 50)->nullable()->after('birth_date');
            $table->string('card_number', 16)->nullable()->after('account_number');
            $table->string('shaba_number', 26)->nullable()->after('card_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['job', 'birth_date', 'account_number', 'card_number', 'shaba_number']);
        });
    }
};
