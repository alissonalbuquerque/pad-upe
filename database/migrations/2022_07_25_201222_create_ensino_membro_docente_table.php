<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsinoMembroDocenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensino_membro_docente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_pad_id')->notNull();
            $table->tinyInteger('dimensao')->nullable();
            $table->string('cod_atividade')->notNull();
            $table->string('nucleo')->notNull();
            $table->string('documento')->notNull();
            $table->tinyInteger('funcao')->notNull();
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
        Schema::dropIfExists('ensino_membro_docente');
    }
}
