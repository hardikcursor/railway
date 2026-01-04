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
