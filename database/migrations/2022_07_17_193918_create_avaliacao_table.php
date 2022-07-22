<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarefa_id')->notNull();
            $table->foreignId('avaliador_id')->nullable();
            $table->tinyInteger('type')->notNull();
            $table->tinyInteger('status')->notNull();
            $table->string('descricao')->nullable();
            $table->integer('ch_semanal')->nullable();
            $table->integer('ch_total')->nullable();
            
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
        Schema::dropIfExists('avaliacao');
    }
}
