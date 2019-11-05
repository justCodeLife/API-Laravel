<?php

use App\Course;
use App\Episode;
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $password ?: $password = bcrypt('secret'),
        'api_token' => Str::random(100),
        'remember_token' => Str::random(10)
    ];
});

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->paragraph(5),
        'price' => $faker->numberBetween(1000, 10000),
        'image' => $faker->imageUrl(),
    ];
});

$factory->define(Episode::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->paragraph(5),
        'videoUrl' => 'exampleURL'
    ];
});
