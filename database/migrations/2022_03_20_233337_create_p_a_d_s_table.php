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
        Schema::create('pads', function (Blueprint $table) {
            $table->id();
            // $table->integer('ano')->default(false);
            // $table->integer('semestre')->default(false);
            // $table->integer('carga_horaria')->default(false);
            // $table->string('categoria', 20)->default(false);
            // $table->boolean('afastamento_total')->default(false);
            // $table->boolean('afastamento_parcial')->default(false);
            // $table->boolean('exerce_funcao_admin')->default(false);
            // $table->boolean('exerce_funcao_sindical')->default(false);
            // $table->string('licenca_de_acor_legais', 50)->default(null);
            // $table->string('outras_observacoes', 200)->nullable(true);
            
            $table->foreignId('user_id');
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
        Schema::dropIfExists('pads');
    }
}
