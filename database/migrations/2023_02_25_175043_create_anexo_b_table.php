<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexoBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexo_b', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_pad_id')->notNull();
            $table->foreignId('campus_id');
            $table->foreignId('curso_id');
            $table->tinyInteger('semestre');
            $table->string('matricula');
            $table->double('carga_horaria');
            $table->tinyInteger('categoria_nivel');
            $table->boolean('afastamento_total');
            $table->string('afastamento_total_desc');
            $table->boolean('afastamento_parcial');
            $table->string('afastamento_parcial_desc');
            $table->boolean('direcao_sindical');
            $table->string('licenca');
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
