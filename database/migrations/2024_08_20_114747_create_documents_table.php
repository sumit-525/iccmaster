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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category_id');
            $table->string('document');
            $table->string('startdate')->nullable();
            $table->string('enddate')->nullable();
            $table->string('documentstatus')->nullable();
            $table->string('documentcount')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('position_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
