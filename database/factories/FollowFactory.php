<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Follow;
use Faker\Generator as Faker;

$factory->define(Follow::class, function (Faker $faker) {
    return [
        'following_id' => $faker->numberBetween($min = 1, $max = 10),
        'followed_id'  => $faker->numberBetween($min = 1, $max = 10),
    ];
});
