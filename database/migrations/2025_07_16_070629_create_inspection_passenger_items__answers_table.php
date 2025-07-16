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
        Schema::create('inspection_passenger_items__answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Foreign key to users');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('report_id')->comment('Foreign key to reports');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('inspection_id')->comment('Foreign key to inspection_passenger_items ');
            $table->foreign('inspection_id')->references('id')->on('inspection_passenger_items')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('yes_no')->comment('Answers provided by the yes =1, no =0');
            $table->longText('remark')->nullable()->comment('remark provided by the inspection officer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_passenger_items__answers');
    }
};
