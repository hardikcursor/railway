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
        Schema::create('inspection_pay_use_toilets_location_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inspection_id')->comment('Foreign key to reports');
            $table->foreign('inspection_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->string('location');
            $table->string('Gents')->comment('No.of WC');
            $table->string('Ladies')->comment('No.of WC');
            $table->string('Gents_Urinals')->comment('No.of Urinals');
            $table->string('Ladies_Urinals')->comment('No.of Urinals');
            $table->string('Divyang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_pay_use_toilets_location_forms');
    }
};
