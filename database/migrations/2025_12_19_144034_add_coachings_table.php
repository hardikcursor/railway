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
            $table->string('Name');
            $table->string('Station');
            $table->string('Unreserved_Passengers');
            $table->string('Unreserved_Earning');
            $table->string('Reserved_Passengers');
            $table->string('Reserved_Earning');
            $table->string('Total_Passengers');
            $table->string('Total_Earning');
            $table->string('Date');
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
