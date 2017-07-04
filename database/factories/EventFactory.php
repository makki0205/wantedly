<?php
/**
 * Created by PhpStorm.
 * User: nappannda
 * Date: 2016/11/19
 * Time: 21:22
 */
$factory->define(App\Event::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence(),
        'catch_image' => $faker->url(),
        'place' => $faker->address(),
        'day' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = date_default_timezone_get()),
        'genre' => $faker->randomDigitNotNull(),
        'tag' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'content' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true)
    ];
});