<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RegionTableSeeder::class);
        $this->call(GenreTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TopicTableSeeder::class);
        $this->call(AspiringIndustryTableSeeder::class);
    }
}
