<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefPlanejamentoChesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_planejamento_ches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("descricao_atividade", 50);
            $table->float("ch_semanal", 5, 2);
            $table->float("ch_maxima", 5, 2);
            $table->foreignId('PAD_id')
                ->constrained('pads')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('ref_planejamento_ches');
    }
}
