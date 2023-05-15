<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAnexoRemakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::dropIfExists('anexo_b');

        Schema::create('anexo_b', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_pad_id');

            $table->foreignId('campus_id')->nullable();
            $table->foreignId('curso_id')->nullable();
            $table->tinyInteger('semestre')->nullable();
            $table->string('matricula')->nullable();
            $table->time('carga_horaria')->nullable();
            $table->tinyInteger('categoria_nivel')->nullable();
            $table->boolean('afastamento_total')->nullable();
            $table->string('afastamento_total_desc')->nullable();
            $table->boolean('afastamento_parcial')->nullable();
            $table->string('afastamento_parcial_desc')->nullable();
            $table->boolean('direcao_sindical')->nullable();
            $table->string('licenca')->nullable();

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
        Schema::dropIfExists('anexo_b');
    }
}
