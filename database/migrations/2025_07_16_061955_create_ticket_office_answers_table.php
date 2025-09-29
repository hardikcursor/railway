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
        Schema::create('ticket_office_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Foreign key to users');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('inspection_id')->comment('Foreign key to reports');
            $table->foreign('inspection_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('ticket_question_id')->comment('Foreign key to ticket__examineroffice');
            $table->foreign('ticket_question_id')->references('id')->on('ticket__examineroffices')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ticket_office_answers');
    }
};
