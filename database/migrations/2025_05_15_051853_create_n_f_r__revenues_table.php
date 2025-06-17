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
        Schema::create('n_f_r__revenues', function (Blueprint $table) {
            $table->id();
            $table->string('station')->nullable();
            $table->string('location')->nullable();
            $table->string('station_category')->nullable();
            $table->string('unit_policy')->nullable();
            $table->string('type_of_unit')->nullable();
            $table->decimal('area_in_sqm', 10, 2)->nullable();
            $table->integer('period_in_months')->nullable();
            $table->date('period_start')->nullable();
            $table->date('expiring_on')->nullable();
            $table->decimal('yearly_license_fees', 15, 2)->nullable();
            $table->string('fee_paid_upto_month')->nullable();
            $table->decimal('fee_paid_upto_rs', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('n_f_r__revenues');
    }
};
