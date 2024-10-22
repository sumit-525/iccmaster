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
        Schema::create('port_wises', function (Blueprint $table) {
            $table->id();
            $table->string('CUSH')->nullable();
            $table->string('INDIAN_PORT')->nullable();
            $table->string('BE_NO')->nullable();
            $table->string('BE_DATE')->nullable();
            $table->string('IEC')->nullable();
            $table->string('IMPORTER')->nullable();
            $table->text('ADDRESS')->nullable();
            $table->string('CITY')->nullable();
            $table->string('CHA_NO')->nullable();
            $table->string('COUNTRY')->nullable();
            $table->string('CTH')->nullable();
            $table->string('ITEM')->nullable();
            $table->string('QTY')->nullable();
            $table->string('UQC')->nullable();
            $table->string('UNIT_VALUE')->nullable();
            $table->string('TOTAL_VALUE')->nullable();
            $table->string('UPI')->nullable();
            $table->string('ASSESS_USD')->nullable();
            $table->string('Total_Duty_Paid')->nullable();
            $table->string('AG')->nullable();
            $table->string('Port_Of_Shipment')->nullable();
            $table->string('Invoice_Currency')->nullable();
            $table->string('Supp_Name')->nullable();
            $table->text('Supp_Address')->nullable();
            $table->string('InvoiceUnitPriceFC')->nullable();
            $table->string('TYPE')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port_wises');
    }
};
