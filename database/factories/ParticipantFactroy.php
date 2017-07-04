<?php
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2017/01/03
 * Time: 17:24
 */
$factory->define(App\Participant::class, function (Faker\Generator $faker) {

    return [
        'event_id' => $faker->randomDigitNotNull(),
        'user_id' => $faker->randomDigitNotNull(),
        'entry_id' => $faker->randomDigitNotNull(),
        'event_evaluate' => $faker->randomDigitNotNull()
    ];
});