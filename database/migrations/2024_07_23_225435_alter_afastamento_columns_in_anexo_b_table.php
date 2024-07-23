<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAfastamentoColumnsInAnexoBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anexo_b', function (Blueprint $table) {
            $table->text('afastamento_total_desc')->change();
            $table->text('afastamento_parcial_desc')->change();
            $table->text('licenca')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anexo_b', function (Blueprint $table) {
            $table->string('afastamento_total_desc');
            $table->string('afastamento_parcial_desc');
            $table->string('licenca');
        });
    }
}
