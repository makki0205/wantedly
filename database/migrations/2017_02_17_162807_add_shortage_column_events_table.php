<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortageColumnEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('join_pay'); //参加費用
            $table->string('place_title'); //場所名
            $table->string('start_time'); //開始時間
            $table->string('end_time'); //終了時間
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('join_pay');
            $table->dropColumn('place_title');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
}
