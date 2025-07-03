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
        Schema::create('i_n_s_p_e_c_t_i_o_n__t_e_a_s', function (Blueprint $table) {
            $table->id();   
            $table->string('Particulars')->comment('Details of the Inspection Items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_n_s_p_e_c_t_i_o_n__t_e_a_s');
    }
};
