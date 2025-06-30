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
        Schema::create('booking_office_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_office_id')->comment('Foreign key to booking_offices table');
            $table->foreign('booking_office_id')->references('id')->on('booking_offices')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('remarks')->comment('Answers provided by the booking office');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_office_answers');
    }
};
