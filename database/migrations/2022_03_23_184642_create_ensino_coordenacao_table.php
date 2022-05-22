<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsinoCoordenacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensino_coordenacao', function (Blueprint $table) {
            $table->id();
            $table->string('cod_atividade')->notNull();
            $table->string('componente_curricular')->notNull();
            $table->foreignId('curso_id')->notNull();
            $table->tinyInteger('nivel')->notNull();
            $table->tinyInteger('modalidade')->notNull();
            $table->integer('ch_semanal')->notNull();
            $table->foreignId('pad_id')->notNull();
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
        Schema::dropIfExists('ensino_coordenacao');
    }
}
