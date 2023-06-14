<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChangeCategoriaNivelToVarcharAnexoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anexo_b', function (Blueprint $table) {
            $table->string('categoria_nivel')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anexo_b', function (Blueprint $table) {
            $table->tinyInteger('categoria_nivel')->change();
        });
    }
}
