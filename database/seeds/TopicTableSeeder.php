<?php

use Illuminate\Database\Seeder;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Topic::create(['topic'=>'オフィス訪問']);
        App\Topic::create(['topic'=>'勉強会']);
        App\Topic::create(['topic'=>'仕事仲間']);
        App\Topic::create(['topic'=>'勉強会']);
        App\Topic::create(['topic'=>'ハッカソン']);
        App\Topic::create(['topic'=>'志向の合う仲間']);
        App\Topic::create(['topic'=>'インターン']);
        App\Topic::create(['topic'=>'講演会']);
        App\Topic::create(['topic'=>'他業種の仲間']);
        App\Topic::create(['topic'=>'専門分野の相談にのる']);
        App\Topic::create(['topic'=>'合同説明会']);
        App\Topic::create(['topic'=>'セミナー']);

    }
}
