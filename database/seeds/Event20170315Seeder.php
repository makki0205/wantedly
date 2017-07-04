<?php

use Illuminate\Database\Seeder;

class Event20170315Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $event = App\Event::create([
            'title' => '【限定３０名】学生起業の理想と現実　〜関西の学生だからこそできる話がある〜【WAVE(β版)】',
            'catch_image' => 'https://s3-us-west-2.amazonaws.com/wave-dev2/media/event_eye_catch/3.16u30a4u30d8u3099u30f3u30c82.png',
            'place' => '〒541-0056　大阪市中央区久太郎町4-1-3 大阪センタービル6F',
            'day' => '2017-3-15 0:0:0',
            'genre' => 2,
            'tag' => '2,3',
            'content' => '   - WAVE（wave-event.net）は大阪大学を始め、HAL大阪、関西大学、大阪芸術大学などに所属する現役の関西の学生だけで作った学生向けイベントプラットフォームです。学生向けイベントへの参加者が困っていること、そのイベントを主催する人が困っていることを丁寧に解決していきました。- 今回は、WAVE（β版）を使うことで学生向けイベントがどのように変わるのか、どこが快適なのかを体感してもらえるイベントになっております。- WAVEが常に目指すのは、関西で熱い学生イベント、学生コミュニティをどんどん増やしていくことです。今回のイベントでは、関西で「熱く」「活発に」活動している学生が登壇し、その想いや楽しさ、苦労などを赤裸々に語ります。また（軽く食べたり飲んだりしながら）学生同士の交流が深められるような場になっております。- WAVEのチャット機能を使い、登壇者に対して気軽に意見・感想・質問を飛ばしてみてください！リアルタイムで参加者と交流できるWAVEを体感できます。',
            'join_pay' => '無料',
            'place_title' => 'MJEWORK',
            'start_time' => '18:00',
            'end_time' => '20:00',
        ]);

        App\Entry::create([
            'event_id' => $event->id,
            'event_entry_name' => "一般参加枠",
            'event_entry_max_num' => 30,
            'event_entry_now_num' => 0,
        ]);

        $format = 'Y-m-d H:i:s';
        App\TimeSchedule::create([
            'event_id' => $event->id,
            'time' => DateTime::createFromFormat($format, '2017-03-15 17:45:00'),
            'content' => "受付"
        ]);
        App\TimeSchedule::create([
            'event_id' => $event->id,
            'time' => DateTime::createFromFormat($format, '2017-03-15 18:00:00'),
            'content' => "MJEWORK(会場)によるプレゼン"
        ]);
        App\TimeSchedule::create([
            'event_id' => $event->id,
            'time' => DateTime::createFromFormat($format, '2017-03-15 18:10:00'),
            'content' => "数名の学生によるプレゼン"
        ]);
        App\TimeSchedule::create([
            'event_id' => $event->id,
            'time' => DateTime::createFromFormat($format, '2017-03-15 19:00:00'),
            'content' => "パネルディスカッション"
        ]);
        App\TimeSchedule::create([
            'event_id' => $event->id,
            'time' => DateTime::createFromFormat($format, '2017-03-15 19:30:00'),
            'content' => "軽食ドリンクありの懇親会"
        ]);
        App\Organizer::create([
            'event_id' => $event->id,
            'user_id' => 1,
            'comment' => "イベント運営補助頑張るぞい",
            'priority_ranking' => 1
        ]);
        echo($event->id);
    }
}
