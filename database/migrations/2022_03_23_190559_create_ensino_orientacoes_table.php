<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsinoOrientacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensino_orientacoes', function (Blueprint $table) {
            $table->id();
            $table->string('cod_atividade')->notNull();
            $table->string('atividade')->notNull();
            $table->foreignId('curso_id')->notNull();
            $table->tinyInteger('nivel')->notNull();
            $table->tinyInteger('type_orientacao')->notNull();
            $table->tinyInteger('numero_orientandos')->nullable();
            $table->integer('ch_semanal')->notNull();
            $table->foreignId('pad_id')->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ensino_orientacoes');
    }
}
