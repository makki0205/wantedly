<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Entry;
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2017/02/18
 * Time: 23:31
 */
class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entries')->delete();

        App\Entry::create([
            'event_id' => 1,
            'event_entry_name' => "捧げ物提供枠",
            'event_entry_max_num' => 5,
            'event_entry_now_num' => 1
        ]);

        App\Entry::create([
            'event_id' => 1,
            'event_entry_name' => "無償で祝う枠",
            'event_entry_max_num' => 10,
            'event_entry_now_num' => 5
        ]);

        App\Entry::create([
            'event_id' => 2,
            'event_entry_name' => "LT枠",
            'event_entry_max_num' => 2,
            'event_entry_now_num' => 1
        ]);

        App\Entry::create([
            'event_id' => 2,
            'event_entry_name' => "参加枠",
            'event_entry_max_num' => 8,
            'event_entry_now_num' => 4
        ]);
    }
}