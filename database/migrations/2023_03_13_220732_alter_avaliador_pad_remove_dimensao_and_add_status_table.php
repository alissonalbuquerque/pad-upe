<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAvaliadorPadRemoveDimensaoAndAddStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avaliador_pad', function (Blueprint $table) {
            $table->dropColumn('dimensao');
            $table->tinyInteger('status')->after('pad_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('avaliador_pad', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->tinyInteger('dimensao')->after('id');
        });
    }
}
