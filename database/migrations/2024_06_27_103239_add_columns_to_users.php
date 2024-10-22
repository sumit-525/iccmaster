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
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(1); // Corrected the typo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns when rolling back the migration
            $table->dropColumn(['address', 'mobile', 'icon', 'status']);
        });
    }
};
