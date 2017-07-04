<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GenreControllerTest extends TestCase
{
    /**
     * @test
	 **/
    public function ジャンルの取得が成功した時、正しくデータが取れているか()
    {
        $this->seed('GenreTableSeeder');
        $this->visit('/api/genre')
            ->see('genre')
            ->see('id')
            ->seeStatusCode(200);
    }
}
