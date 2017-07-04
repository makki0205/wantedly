<?php

use Illuminate\Database\Seeder;
use App\UserDetail;

use Faker\Factory as Faker;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');
        $introduction = '大阪を拠点に、フロントエンドエンジニアとして活動しています。HAL大阪 web開発学科。最近は株式会社Far Connectionが運営する「Tech Logics」と言う約200人のエンジニアやデザイナー、VCの方などが参加しているオンラインコミュニティの代表になったり、関東でも活発なIoT縛りの勉強会（IoTLT）を主催しています。基本的にはJSフレームワークなどを使ってSPAを作って楽しんでいますが、SPAにIoTなどいろいろ盛り込んで遊んでます。他にも、Skyland Ventures, East Ventures主催のイベントのスタッフをやらせていただいています。さらに来年(2017年)には、関西で一番大きなフロントエンドの祭典である「FRONTEND CONFERENCE 2017」の広報且つ当日のスタッフとして参加しています。プログラミングだけでなく、水泳8年、タップダンス8年、バレエ4年、珠算3年とダンサーとして活動していた時期もありました。';
        $first_user_id = App\User::create([   'email' => $faker->email(),
                                        'password'=> $faker->password()
                                        ])->id;
        App\UserDetail::create([
            'user_id'=> $first_user_id,
            'nickname'=> "konojunya",
            'display_name'=> "konojunya",
            'sex'=> '0',
            'cover_image'=> $faker->url(),
            'icon'=> $faker->url(),
            'description'=> "俺様のコードに酔いな",
            'introduction'=> $introduction,
            'school_name'=> 'HAL大阪',
            'undergraduate'=> 'IT学部',
            'graduate'=> '2019/3',
            'address'=> 3,
            'facebook'=> $faker->url(),
            'twitter'=> $faker->url(),
            'topics_id'=> '1,3,4',
            'aspiring_industrie_id'=> '2,3,5,5',
            'number_participate'=> 100,
            'number_build'=> 300,
            'wave_point'=>160
        ]);



        App\UserDetailAward::create(['user_id'=>$first_user_id,'award'=>'基本情報(仮)','date'=>'2017/4']);
        App\UserDetailAward::create(['user_id'=>$first_user_id,'award'=>'応用情報(仮)','date'=>'2017/4']);
        App\UserDetailAward::create(['user_id'=>$first_user_id,'award'=>'ITパスポート','date'=>'2017/4']);


        App\UserDetailCareerHistory::create(['title'=>'lebe','user_id'=>$first_user_id,'Contents'=>'しごかれた','start_time'=>'2017/4','end_time'=>'2017/4']);
        App\UserDetailCareerHistory::create(['title'=>'morein','user_id'=>$first_user_id,'Contents'=>'遊んでた','start_time'=>'2017/4','end_time'=>'2017/4']);

        $second_user_id = App\User::create([   'email' => $faker->email(),
            'password'=> $faker->password()
        ])->id;

        App\UserDetail::create([
            'user_id'=> $second_user_id,
            'nickname'=> "nappa",
            'display_name'=> "nappa",
            'sex'=> '0',
            'cover_image'=> $faker->url(),
            'icon'=> $faker->url(),
            'description'=> "初心者",
            'introduction'=> $introduction,
            'school_name'=> '関西大学',
            'undergraduate'=> '総合情報学部',
            'graduate'=> '2019/3',
            'address'=> 3,
            'facebook'=> $faker->url(),
            'twitter'=> $faker->url(),
            'topics_id'=> '1',
            'aspiring_industrie_id'=> '',
            'number_participate'=> 1,
            'number_build'=> 2,
            'wave_point'=>19
        ]);

        $third_user_id = App\User::create([   'email' => $faker->email(),
            'password'=> $faker->password()
        ])->id;

        App\UserDetail::create([
            'user_id'=> $third_user_id,
            'nickname'=> "makki",
            'display_name'=> "makki",
            'sex'=> '0',
            'cover_image'=> $faker->url(),
            'icon'=> $faker->url(),
            'description'=> "プロ",
            'introduction'=> $introduction,
            'school_name'=> 'HAL大阪',
            'undergraduate'=> 'ロボット',
            'graduate'=> '2019/3',
            'address'=> 3,
            'facebook'=> $faker->url(),
            'twitter'=> $faker->url(),
            'topics_id'=> '1',
            'aspiring_industrie_id'=> '',
            'number_participate'=> 10,
            'number_build'=> 20,
            'wave_point'=>100
        ]);

        $fourth_user_id = App\User::create([   'email' => $faker->email(),
            'password'=> $faker->password()
        ])->id;

        App\UserDetail::create([
            'user_id'=> $fourth_user_id,
            'nickname'=> "ともあき",
            'display_name'=> "ともあき",
            'sex'=> '0',
            'cover_image'=> $faker->url(),
            'icon'=> $faker->url(),
            'description'=> "ともあきです。",
            'introduction'=> $introduction,
            'school_name'=> 'ともあき大学',
            'undergraduate'=> '総合ともあき学部',
            'graduate'=> '20XX/X',
            'address'=> 3,
            'facebook'=> $faker->url(),
            'twitter'=> $faker->url(),
            'topics_id'=> '',
            'aspiring_industrie_id'=> '',
            'number_participate'=> 999,
            'number_build'=> 999,
            'wave_point'=>999
        ]);
    }
}
