<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRemoveFuncaoInExtensaoCoordenacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extensao_coordenacao', function (Blueprint $table) {
            $table->dropColumn('funcao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extensao_coordenacao', function (Blueprint $table) {
            $table->tinyInteger('funcao')->notNull();
        });
    }
}
