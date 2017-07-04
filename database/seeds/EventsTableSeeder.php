<?php
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2016/11/17
 * Time: 13:34
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use App\Event;

class EventsTableSeeder extends Seeder {

    public function run() {
        DB::table('events')->delete();

        $faker = Faker::create('ja_JP');


        App\Event::create([
            'title' => 'せりた〜ずイベント',
            'catch_image' => '',
            'place' => '大阪府大阪市のどこか',
            'day' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = date_default_timezone_get()),
            'genre' => 1,
            'tag' => '2,3',
            'content' => 'せりたのためのせりたによるせりたが得するイベントです。',
            'join_pay' => '100円',
            'place_title' => 'マイホーム',
            'start_time' => '17:00',
            'end_time' => '19:00',
        ]);

        App\Event::create([
            'title' => 'まっき〜ずイベント',
            'catch_image' => '',
            'place' => '大阪府高槻市のどこか',
            'day' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = date_default_timezone_get()),
            'genre' => 2,
            'tag' => '1',
            'content' => 'まっきーのためのまっきーによるまっきーが得するイベントです。',
            'join_pay' => '100000円',
            'place_title' => '阪急高槻市駅ホーム',
            'start_time' => '21:00',
            'end_time' => '24:00',
        ]);

    }
}