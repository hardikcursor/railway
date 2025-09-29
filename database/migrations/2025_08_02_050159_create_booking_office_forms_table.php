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
        Schema::create('booking_office_forms', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('inspection_id')->comment('Foreign key to reports');
            $table->foreign('inspection_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->string('cbs_name');
            $table->string('no_of_duty_staff');
            $table->string('Sanctioned_Cadre');
            $table->string('Available');
            $table->string('Vacancy');
            $table->string('No_of_Counters')->nullable();
            $table->string('UTS');
            $table->string('PRS');
            $table->string('UTS_PRS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_office_forms');
    }
};
