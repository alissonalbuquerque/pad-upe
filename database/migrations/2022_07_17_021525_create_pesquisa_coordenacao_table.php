<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesquisaCoordenacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesquisa_coordenacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_pad_id')->notNull();
            $table->tinyInteger('dimensao')->notNull();
            $table->string('cod_atividade')->notNull();
            $table->string('titulo_projeto')->notNull();
            $table->string('linha_grupo_pesquisa')->notNull();
            $table->tinyInteger('funcao')->notNull();
            $table->string('cod_dimensao')->notNull();
            $table->integer('ch_semanal')->notNull();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesquisa_coordenacao');
    }
}
