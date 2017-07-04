<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailCareerHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_detail_career_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');        //会社名
            $table->longText('Contents');   //内容
            $table->string('start_time');   //働き始め　例)2016/10
            $table->string('end_time');     //働き終わり　例)2020/1
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_detail_career_histories');
    }
}
