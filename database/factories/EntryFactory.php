<?php
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2017/01/03
 * Time: 17:23
 */
$factory->define(App\Entry::class, function (Faker\Generator $faker) {

    return [
        'event_id' => $faker->randomDigitNotNull(),
        'event_entry_name' => $faker->word(),
        'event_entry_max_num' => $faker->randomDigitNotNull(),
        'event_entry_now_num' => 0
    ];
});