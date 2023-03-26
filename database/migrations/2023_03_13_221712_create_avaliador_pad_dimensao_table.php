<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliadorPadDimensaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliador_pad_dimensao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaliador_pad_id')->constrained('avaliador_pad');
            $table->tinyInteger('dimensao');
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
        Schema::dropIfExists('avaliador_pad_dimensao');
    }
}
