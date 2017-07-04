<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');                //id
            $table->integer('event_id');             //イベントID
            $table->string('event_entry_name');      //イベント参加枠名
            $table->integer('event_entry_max_num');  //イベント枠、最大参加数
            $table->integer('event_entry_now_num');  //イベント枠、参加現在参加数
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
