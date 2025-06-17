<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->string('Month', 50)->change(); // Increase to 50 chars
        });
    }

    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->string('Month', 10)->change(); // Optional: revert change
        });
    }
};
