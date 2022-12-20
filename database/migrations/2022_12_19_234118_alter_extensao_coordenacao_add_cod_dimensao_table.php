<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterExtensaoCoordenacaoAddCodDimensaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extensao_coordenacao', function(Blueprint $table) {
            $table->string('cod_dimensao')->after('atividade');
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
            $table->dropColumn('cod_dimensao');
        });
    }
}
