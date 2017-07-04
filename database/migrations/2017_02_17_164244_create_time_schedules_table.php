<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_schedules', function (Blueprint $table) {
            $table->increments('id'); // タイムスケジュールID
            $table->integer('event_id'); // イベントID
            $table->string('time'); // 時間
            $table->string('content'); // 内容
            $table->timestamps(); // タイムスケジュール作成日時、更新日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('time_schedules');
    }
}
