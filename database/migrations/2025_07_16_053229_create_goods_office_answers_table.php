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
        Schema::create('goods_office_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Foreign key to users table');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('report_id')->comment('Foreign key to reports table');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('goods_office_id')->comment('Foreign key to goods__shed_offices table');
            $table->foreign('goods_office_id')->references('id')->on('goods__shed_offices')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('goods_office_answers');
    }
};
