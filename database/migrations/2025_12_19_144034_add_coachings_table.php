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
        Schema::create('coachings', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable();
            $table->string('Station')->nullable();
            $table->string('Unreserved_Passengers')->nullable();
            $table->string('Unreserved_Earning')->nullable();
            $table->string('Reserved_Passengers')->nullable();
            $table->string('Reserved_Earning')->nullable();
            $table->string('Total_Passengers')->nullable();
            $table->string('Total_Earning')->nullable();
            $table->string('Date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
