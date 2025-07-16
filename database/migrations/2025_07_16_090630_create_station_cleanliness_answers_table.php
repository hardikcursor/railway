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
        Schema::create('station_cleanliness_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Foreign key to users');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('report_id')->comment('Foreign key to reports');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('station_clean_id')->comment('Foreign key to station_cleanlinesses');
            $table->foreign('station_clean_id')->references('id')->on('station_cleanlinesses')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('answer')->comment('Answers provided by the booking office');
            $table->string('Black')->nullable();
            $table->string('Blue')->nullable();
            $table->string('Green')->nullable();
            $table->longText('remark')->nullable()->comment('remark provided by the  station cleanliness');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('station_cleanliness_answers');
    }
};
