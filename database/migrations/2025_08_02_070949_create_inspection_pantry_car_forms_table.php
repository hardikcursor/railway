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
        Schema::create('inspection_pantry_car_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inspection_id')->comment('Foreign key to reports');
            $table->foreign('inspection_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_of_inspection')->nullable();
            $table->string('train_no')->nullable();
            $table->string('train_name')->nullable();
            $table->string('inspecting_official')->nullable();
            $table->string('designation')->nullable();
            $table->string('pantry_car_no')->nullable();
            $table->string('pantry_car_manager')->nullable();
            $table->string('contractor_name')->nullable();
            $table->string('irctc_supervisor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_pantry_car_forms');
    }
};
