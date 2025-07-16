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
        Schema::create('inspection_pay_use_toilets_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('Foreign key to users table');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('report_id')->comment('Foreign key to reports table');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('inspection_pay_id')->comment('Foreign key to inspection_pay_use_toilets table');
            $table->foreign('inspection_pay_id')->references('id')->on('inspection_pay_use_toilets')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('Remar_Observations');
            $table->longText('Minor_deficiencies');
            $table->longText('Major_deficiencies_Proposed');
            $table->longText('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_pay_use_toilets_answers');
    }
};
