<?php

use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Genre::create(['genre'=>'IT/テクノロジー']);
        App\Genre::create(['genre'=>'起業/ベンチャー']);
        App\Genre::create(['genre'=>'大企業/安定']);
        App\Genre::create(['genre'=>'地方創生']);
        App\Genre::create(['genre'=>'教育']);
    }
}
