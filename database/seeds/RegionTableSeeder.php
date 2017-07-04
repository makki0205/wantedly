<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 都道府県を追加する
     */
    public function run()
    {
        //
         App\Region::create(['region'=>'未設定']);
         App\Region::create(['region'=>'北海道']);
		 App\Region::create(['region'=>'青森県']);
		 App\Region::create(['region'=>'岩手県']);
		 App\Region::create(['region'=>'宮城県']);
		 App\Region::create(['region'=>'秋田県']);
		 App\Region::create(['region'=>'山形県']);
		 App\Region::create(['region'=>'福島県']);
		 App\Region::create(['region'=>'茨城県']);
		 App\Region::create(['region'=>'栃木県']);
		 App\Region::create(['region'=>'群馬県']);
		 App\Region::create(['region'=>'埼玉県']);
		 App\Region::create(['region'=>'千葉県']);
		 App\Region::create(['region'=>'東京都']);
		 App\Region::create(['region'=>'神奈川県']);
		 App\Region::create(['region'=>'新潟県']);
		 App\Region::create(['region'=>'富山県']);
		 App\Region::create(['region'=>'石川県']);
		 App\Region::create(['region'=>'福井県']);
		 App\Region::create(['region'=>'山梨県']);
		 App\Region::create(['region'=>'長野県']);
		 App\Region::create(['region'=>'岐阜県']);
		 App\Region::create(['region'=>'静岡県']);
		 App\Region::create(['region'=>'愛知県']);
		 App\Region::create(['region'=>'三重県']);
		 App\Region::create(['region'=>'滋賀県']);
		 App\Region::create(['region'=>'京都府']);
		 App\Region::create(['region'=>'大阪府']);
		 App\Region::create(['region'=>'兵庫県']);
		 App\Region::create(['region'=>'奈良県']);
		 App\Region::create(['region'=>'和歌山県']);
		 App\Region::create(['region'=>'鳥取県']);
		 App\Region::create(['region'=>'島根県']);
		 App\Region::create(['region'=>'岡山県']);
		 App\Region::create(['region'=>'広島県']);
		 App\Region::create(['region'=>'山口県']);
		 App\Region::create(['region'=>'徳島県']);
		 App\Region::create(['region'=>'香川県']);
		 App\Region::create(['region'=>'愛媛県']);
		 App\Region::create(['region'=>'高知県']);
		 App\Region::create(['region'=>'福岡県']);
		 App\Region::create(['region'=>'佐賀県']);
		 App\Region::create(['region'=>'長崎県']);
		 App\Region::create(['region'=>'熊本県']);
		 App\Region::create(['region'=>'大分県']);
		 App\Region::create(['region'=>'宮崎県']);
		 App\Region::create(['region'=>'鹿児島県']);
		 App\Region::create(['region'=>'沖縄県']);
    }
}
