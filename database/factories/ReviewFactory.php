<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Info;
use App\Vote;



$factory->define(Review::class, function (Faker $faker) {
    $now =Carbon::now();
    $info = App\Info::pluck('id')->toArray();

    return [
        'info_id' => $faker->randomElement($info),
        'author' => $faker->name,
        'body' => $faker->realText(100),
        'created_at' => $faker->dateTimeBetween('-2 years', $now)
    ];
});
