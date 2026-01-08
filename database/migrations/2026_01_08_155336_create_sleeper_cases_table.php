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
        Schema::create('sleeper_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_checking_id')
                ->constrained('ticketcheckings')
                ->cascadeOnDelete();
            $table->integer('staff');
            $table->integer('case');
            $table->bigInteger('amount');
            $table->decimal('avg_case', 8, 2);
            $table->decimal('avg_amt', 10, 2);
            $table->bigInteger('amt_ly');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sleeper_cases');
    }
};
