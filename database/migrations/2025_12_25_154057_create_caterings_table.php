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
        Schema::create('caterings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_of_unit');
            $table->string('category');
            $table->string('station');
            $table->string('unit_type')->nullable();
            $table->integer('total_units')->nullable();
            $table->string('type_of_unit')->nullable();
            $table->string('platform_no')->nullable();
            $table->decimal('annual_license_fee', 15, 2)->nullable();
            $table->string('category_of_unit')->nullable();
            $table->string('unit_allotted')->nullable();
            $table->decimal('annual_fee', 10, 2);
            $table->date('date_of_commencement')->nullable();
            $table->decimal('unit_income', 15, 2)->nullable();
            $table->decimal('fee_paid', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caterings');
    }
};
