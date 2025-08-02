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
        Schema::create('ticket__examineroffice_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inspection_id')->comment('Foreign key to reports');
            $table->foreign('inspection_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->string('cti_name');
            $table->string('no_of_duty_staff');
            $table->string('Sanctioned_Cadre');
            $table->string('Available');
            $table->string('Vacancy_Excess');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket__examineroffice_forms');
    }
};
