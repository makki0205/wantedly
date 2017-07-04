<?php
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2016/12/15
 * Time: 9:20
 */
$factory->define(App\Organizer::class, function (Faker\Generator $faker) {

    return [
        'event_id' => $faker->randomDigitNotNull(),
        'user_id' => $faker->randomDigitNotNull(),
        'comment' => $faker->sentence(),
        'priority_ranking' => $faker->randomDigitNotNull()
    ];
});