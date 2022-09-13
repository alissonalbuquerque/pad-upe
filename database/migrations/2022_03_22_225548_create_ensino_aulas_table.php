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
            $table->foreignId('user_pad_id')->notNull();
            $table->tinyInteger('dimensao')->notNull();
            $table->string('cod_atividade')->notNull();
            $table->string('componente_curricular')->notNull();
            $table->string('curso')->notNull();
            $table->tinyInteger('nivel')->notNull();
            $table->tinyInteger('modalidade')->notNull();
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
        Schema::dropIfExists('ensino_aulas');
    }
    
}
