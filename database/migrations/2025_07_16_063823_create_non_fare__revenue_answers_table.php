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
        Schema::create('non_fare__revenue_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Foreign key to users');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('report_id')->comment('Foreign key to reports');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('non_fare_id')->comment('Foreign key to non_fare__revenues');
            $table->foreign('non_fare_id')->references('id')->on('non_fare__revenues')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('answer')->comment('Answers provided by the booking office');
            $table->longText('remark')->nullable()->comment('remark provided by the booking office');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_fare__revenue_answers');
    }
};
