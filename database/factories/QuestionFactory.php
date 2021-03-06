<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'title'=> rtrim($faker->sentence(rand(5, 7)), "."),
        'body' => $faker->paragraph(rand(3, 7), true),
        'views'=> rand(0, 10),
        //'answers_count'=> rand(0, 10),
        'votes'=> rand(0, 10),
    ];
});
