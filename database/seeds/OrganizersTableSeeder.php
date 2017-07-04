<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use App\Organizer;

class OrganizersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizers')->delete();

        $faker = Faker::create('ja_JP');

        App\Organizer::create([
            'event_id' => 1,
            'user_id' => 1,
            'comment' => "イベント主催頑張るぞい",
            'priority_ranking' => 1
        ]);

        App\Organizer::create([
            'event_id' => 1,
            'user_id' => 2,
            'comment' => "イベント運営補助頑張るぞい",
            'priority_ranking' => 2
        ]);

        App\Organizer::create([
            'event_id' => 2,
            'user_id' => 3,
            'comment' => "一人で運営頑張るぞい",
            'priority_ranking' => 1
        ]);

    }
}
