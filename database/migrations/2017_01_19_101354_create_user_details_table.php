<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');                //id
            $table->integer('user_id')->unique();
            $table->string('nickname')->unique();         //ニックネーム
            $table->integer('sex');             //性別
            $table->string('cover_image');      //カバー画像のURL
            $table->string('icon');             //アイコン画像のURL
            $table->string('description');             //ひとこと
            $table->longText('introduction');   //自己紹介文
            $table->string('school_name');      //学校名
            $table->string('undergraduate');    //学部名
            $table->string('graduate');         //何年卒
            $table->integer('address');         //現在住んでいる都道府県のID
            $table->string('facebook');         //facebookのアカウント
            $table->string('twitter');              //ツイッターのアカウント
            $table->string('topics_id');            //関心のあるトピックスのID(コンマ区切り)
            $table->string('aspiring_industrie_id');//関心のある志望業界のID(コンマ区切り)
            $table->integer('number_participate');  //イベント参加回数
            $table->integer('number_build');        //イベント主催回数
            $table->integer('wave_point');        //waveのポイント
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
        Schema::dropIfExists('user_details');
    }
}
