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
        Schema::create('p_r_s_office_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Foreign key to users table');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('report_id')->comment('Foreign key to reports table');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('prs_office_id')->comment('Foreign key to p_r_s_offices table');
            $table->foreign('prs_office_id')->references('id')->on('p_r_s_offices')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('p_r_s_office_answers');
    }
};
