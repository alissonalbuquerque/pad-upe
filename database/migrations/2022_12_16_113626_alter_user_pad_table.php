<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserPadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('user_pad', function (Blueprint $table) {
            $table->dropColumn('user_type_id');
            $table->foreignId('user_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('user_pad', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->foreignId('user_type_id')->after('id');
        });
    }
}
