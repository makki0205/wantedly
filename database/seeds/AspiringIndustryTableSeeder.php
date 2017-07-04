<?php

use Illuminate\Database\Seeder;

class AspiringIndustryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\AspiringIndustry::create(['aspiring_industry'=>'テレビ']);
        App\AspiringIndustry::create(['aspiring_industry'=>'広告']);
        App\AspiringIndustry::create(['aspiring_industry'=>'出版']);
        App\AspiringIndustry::create(['aspiring_industry'=>'コンサル']);
        App\AspiringIndustry::create(['aspiring_industry'=>'銀行']);
        App\AspiringIndustry::create(['aspiring_industry'=>'自動車']);
        App\AspiringIndustry::create(['aspiring_industry'=>'電機']);
        App\AspiringIndustry::create(['aspiring_industry'=>'商社']);
        App\AspiringIndustry::create(['aspiring_industry'=>'インターネット']);
        App\AspiringIndustry::create(['aspiring_industry'=>'人材']);
        App\AspiringIndustry::create(['aspiring_industry'=>'ゲーム']);
        App\AspiringIndustry::create(['aspiring_industry'=>'証券']);
        App\AspiringIndustry::create(['aspiring_industry'=>'生保']);
        App\AspiringIndustry::create(['aspiring_industry'=>'損保']);
        App\AspiringIndustry::create(['aspiring_industry'=>'不動産']);
        App\AspiringIndustry::create(['aspiring_industry'=>'ゼネコン']);
        App\AspiringIndustry::create(['aspiring_industry'=>'鉄鋼']);
        App\AspiringIndustry::create(['aspiring_industry'=>'製薬']);
        App\AspiringIndustry::create(['aspiring_industry'=>'ビール']);
        App\AspiringIndustry::create(['aspiring_industry'=>'製菓']);
        App\AspiringIndustry::create(['aspiring_industry'=>'新聞']);
        App\AspiringIndustry::create(['aspiring_industry'=>'旅行']);
        App\AspiringIndustry::create(['aspiring_industry'=>'百貨店']);
        App\AspiringIndustry::create(['aspiring_industry'=>'通信']);
        App\AspiringIndustry::create(['aspiring_industry'=>'空運・海運・陸運']);
        App\AspiringIndustry::create(['aspiring_industry'=>'食品']);
        App\AspiringIndustry::create(['aspiring_industry'=>'トイレタリー']);
        App\AspiringIndustry::create(['aspiring_industry'=>'エンタメ']);
    }
}
