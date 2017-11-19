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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->userName,
        'github_id' => random_int(10000, 50000),
        'avatar' => $faker->imageUrl(400, 400),
        'bio' => $faker->paragraph,
        'airport_code' => 'IST',
        'twitter_handle' => $faker->userName,
        'url' => $faker->url,
        'desire_transportation' => 0,
        'desire_accommodation' => 0,
        'is_sponsor' => 0,
        'role' => 'user',
        'remember_token' => str_random(10),
    ];
});
