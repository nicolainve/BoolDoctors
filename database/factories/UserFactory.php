<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
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
    $userName = $faker->userName;
    $uniqueSuffix = $faker->word;
    $domain =  $faker->randomElement(['google.com', 'hotmail.com', 'libero.it', 'virgilio.it', 'yahoo.com']);
    $uniqueFakeEmail ="$userName.$uniqueSuffix@$domain";
    return [
        'email' => $uniqueFakeEmail,
        'password' => Hash::make('123456789'), // password
        // 'remember_token' => Str::random(10),
    ];
});

