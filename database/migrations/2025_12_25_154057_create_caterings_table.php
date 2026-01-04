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
            $table->string('name');
            $table->string('category');
            $table->string('station');
            $table->string('unit_type');
            $table->integer('total_units');
            $table->decimal('annual_fee', 10, 2);
            $table->decimal('fee_paid', 10, 2);
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
