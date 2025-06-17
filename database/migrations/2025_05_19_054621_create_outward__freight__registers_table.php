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
        Schema::create('outward__freight__registers', function (Blueprint $table) {
            $table->id();
            $table->string('dvsn')->nullable();
            $table->string('station_from')->nullable();
            $table->string('station_to')->nullable();
            $table->string('rr_number')->nullable();
            $table->date('rr_date')->nullable();
            $table->date('invoice_date')->nullable();
            $table->integer('cmdt_code')->nullable();
            $table->integer('8_WHLR')->nullable();
            $table->decimal('weight_chrg', 15, 2)->nullable();
            $table->integer('total_frgt')->nullable();
            $table->string('siding_type')->nullable();
            $table->string('rake_type')->nullable();
            $table->string('wagon_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outward__freight__registers');
    }
};
