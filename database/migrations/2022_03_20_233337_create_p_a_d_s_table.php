<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePADSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_a_d_s', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('ano');
            $table->integer('semestre');
            $table->integer('carga_horaria');
            $table->string('categoria', 20);
            $table->boolean('afastamento_total')->default(false);
            $table->boolean('afastamento_parcial')->default(false);
            $table->boolean('exerce_funcao_admin')->default(false);
            $table->boolean('exerce_funcao_sindical')->default(false);
            $table->string('licenca_de_acor_legais', 50)->default(null);
            $table->string('outras_observacoes', 200)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_a_d_s');
    }
}
