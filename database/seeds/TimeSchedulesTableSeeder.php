<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\TimeSchedule;
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2017/02/18
 * Time: 23:23
 */
class TimeSchedulesTableSeeder extends Seeder
{
    public function run() {
        DB::table('time_schedules')->delete();

        $format = 'Y-m-d H:i:s';
        App\TimeSchedule::create([
            'event_id' => 1,
            'time' => DateTime::createFromFormat($format, '2017-03-01 19:00:00'),
            'content' => "開場"
        ]);

        App\TimeSchedule::create([
            'event_id' => 1,
            'time' => DateTime::createFromFormat($format, '2017-03-01 19:30:00'),
            'content' => "スタート"
        ]);

        App\TimeSchedule::create([
            'event_id' => 1,
            'time' => DateTime::createFromFormat($format, '2017-03-01 21:00:00'),
            'content' => "終了"
        ]);

        App\TimeSchedule::create([
            'event_id' => 2,
            'time' => DateTime::createFromFormat($format, '2017-03-05 21:00:00'),
            'content' => "集合"
        ]);

        App\TimeSchedule::create([
            'event_id' => 2,
            'time' => DateTime::createFromFormat($format, '2017-03-05 21:30:00'),
            'content' => "騒ぐ"
        ]);

        App\TimeSchedule::create([
            'event_id' => 2,
            'time' => DateTime::createFromFormat($format, '2017-03-05 23:00:00'),
            'content' => "解散"
        ]);

    }
}