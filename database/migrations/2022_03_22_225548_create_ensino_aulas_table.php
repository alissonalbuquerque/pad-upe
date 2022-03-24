<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsinoAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensino_aulas', function (Blueprint $table) {
            $table->id();
            $table->string('cod_atividade')->notNull();
            $table->string('componente_curricular')->notNull();
            $table->foreignId('curso_id')->notNull();
            $table->tinyInteger('nivel')->notNull();
            $table->tinyInteger('modalidade')->notNull();
            $table->integer('ch_semanal')->notNull();
            $table->integer('ch_total')->notNull();
            $table->foreignId('pad_id');
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
        Schema::dropIfExists('ensino_aulas');
    }
}
