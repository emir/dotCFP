<?php

use Faker\Generator as Faker;

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

$factory->define(\App\Vote::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            factory(\App\User::class)->create()->id;
        },
        'talk_id' => function() {
            factory(\App\Talk::class)->create()->id;
        },
        'vote' => $faker->numberBetween(1, 5)
    ];
});
