<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Talk::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\App\User::class)->create();
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'additional_information' => $faker->paragraph,
        'duration' => 40,
        'slide' => 'https://speakerdeck.com/user/test-slide',
        'is_favorite' => 0,
        'average_vote' => 0,
        'status' => 0,
    ];
});
