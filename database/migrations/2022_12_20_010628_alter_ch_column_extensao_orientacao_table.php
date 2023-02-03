<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChColumnExtensaoOrientacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extensao_orientacao', function(Blueprint $table) {
            $table->decimal('ch_semanal', 4, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extensao_orientacao', function(Blueprint $table) {
            $table->integer('ch_semanal')->change();
        });
    }
}
