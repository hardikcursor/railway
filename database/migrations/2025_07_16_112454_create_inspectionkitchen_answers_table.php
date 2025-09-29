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
        Schema::create('inspectionkitchen_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Foreign key to users');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('inspection_id')->comment('Foreign key to reports');
            $table->foreign('inspection_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('inspectionkitchen_question_id')->comment('Foreign key to inspection kitchen');
            $table->foreign('inspectionkitchen_question_id')->references('id')->on('i_n_s_p_e_c_t_i_o_n_k_i_t_c_h_e_n_s')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('yes_no')->comment('Answers provided by the yes =1, no =0');
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
        Schema::dropIfExists('inspectionkitchen_answers');
    }
};
