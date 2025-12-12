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
        Schema::table('reports', function (Blueprint $table) {
               $table->text('forward_admin_id')->nullable()->after('forward_user_id');
            $table->text('approve_status')->nullable()->after('forward_admin_id');
            $table->text('check_status_id')->nullable()->after('approve_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('forward_admin_id')->nullable();
            $table->unsignedBigInteger('approve_status')->nullable();
            $table->unsignedBigInteger('check_status_id')->nullable();

        });
    }
};
