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
        Schema::create('freights', function (Blueprint $table) {
            $table->id();
            $table->string('div')->nullable();
            $table->string('station_from')->nullable();
            $table->string('station_to')->nullable();
            $table->string('rr_number')->nullable();
            $table->date('rr_date')->nullable();
            $table->string('rr_e_rr')->nullable();
            $table->string('rr_et_rr')->nullable();
            $table->string('traffic_type')->nullable();
            $table->string('paid_type')->nullable();
            $table->string('flag')->nullable();
            $table->string('invoice_no')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('cmdt_code')->nullable();
            $table->string('cnsr_code')->nullable();
            $table->string('cnsg_code')->nullable();
            $table->string('eight_wheeler')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('paid_by')->nullable();
            $table->decimal('distance_chrg', 15, 2)->nullable();
            $table->decimal('weight_chrg', 15, 2)->nullable();
            $table->decimal('weight_actl', 15, 2)->nullable();
            $table->decimal('weight_pol1', 15, 2)->nullable();
            $table->decimal('weight_pol2', 15, 2)->nullable();
            $table->string('chbl_class')->nullable();
            $table->decimal('rate_per_ton', 10, 2)->nullable();
            $table->decimal('basic_frgt', 15, 2)->nullable();
            $table->decimal('total_frgt', 15, 2)->nullable();
            $table->string('fr_sort')->nullable();
            $table->integer('fr_month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('year_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freights');
    }
};
