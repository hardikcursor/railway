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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('Station')->nullable();
            $table->bigInteger('UR_Pass')->nullable();
            $table->bigInteger('UR_Earning')->nullable();
            $table->bigInteger('Rsvd_Pass')->nullable();
            $table->bigInteger('Rsvd_Earning')->nullable();
            $table->date('Date')->nullable();
            $table->float('UR_Pass_Lakh')->nullable();
            $table->float('UR_Er_Cr')->nullable();
            $table->float('Rsvd_Pass_Lakh')->nullable();
            $table->float('Rsvd_Er_Cr')->nullable();
            $table->float('Total_Pass_Lakh')->nullable();
            $table->float('Total_Er_Cr')->nullable();
            $table->string('Month', 50)->nullable();
            $table->string('M_short')->nullable();
            $table->string('Year')->nullable();
            $table->string('FY')->nullable();
            $table->string('T_short')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
