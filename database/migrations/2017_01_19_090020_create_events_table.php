<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id'); // イベントid
            $table->string('title'); // イベントタイトル
            $table->string('catch_image'); // イベント画像
            $table->string('place'); // イベントの場所
            $table->dateTime('day'); // イベント日時
            $table->integer('genre'); // イベントジャンル
            $table->longText('tag'); // イベントタグ
            $table->longText('content'); // イベント内容
            $table->timestamps(); // イベント作成日時、更新日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
