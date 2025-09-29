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
            $table->foreign('user_id', 'fk_iputa_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('inspection_id')->comment('Foreign key to reports table');
            $table->foreign('inspection_id', 'fk_iputa_inspection_id')
                ->references('id')->on('reports')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('inspection_pay_question_id')->comment('Foreign key to inspection_pay_use_toilets table');
            $table->foreign('inspection_pay_question_id', 'fk_iputa_question_id')
                ->references('id')->on('inspection_pay_use_toilets')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->longText('Remar_Observations');
            $table->longText('Minor_deficiencies');
            $table->longText('Major_deficiencies_Proposed');
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
        Schema::dropIfExists('inspection_pay_use_toilets_answers');
    }
};
