<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanejamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planejamentos', function (Blueprint $table) {
            $table->id();
            $table->string('cod_dimensao')->notNull();
            $table->tinyInteger('dimensao')->notNull();
            $table->string('descricao')->notNull();
            $table->integer('ch_semanal')->nullable();
            $table->integer('ch_maxima')->nullable();
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
        Schema::dropIfExists('planejamentos');
    }
}
