<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChColumnsPlanejamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('planejamentos', function(Blueprint $table) {
            $table->decimal('ch_semanal', 4, 2)->change();
            $table->decimal('ch_maxima', 4, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planejamentos', function(Blueprint $table) {
            $table->integer('ch_semanal')->change();
            $table->integer('ch_maxima')->change();
        });
    }
}
