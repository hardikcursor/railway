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
        Schema::create('inspection_pantry_car_answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->comment('Foreign key to users table');
            $table->foreign('user_id', 'fk_ipca_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('inspection_id')->comment('Foreign key to reports table');
            $table->foreign('inspection_id', 'fk_ipca_inspection_id')
                ->references('id')->on('reports')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('inspection_pantry_question_id')->comment('Foreign key to inspection_pantry_cars table');
            $table->foreign('inspection_pantry_question_id', 'fk_ipca_question_id')
                ->references('id')->on('inspection_pantry_cars')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->longText('answer');
            $table->longText('remark')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_pantry_car_answers');
    }
};
