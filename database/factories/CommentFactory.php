<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'post_id' => $faker->numberBetween($min = 1, $max = 10),
        'comment' => $faker->realText($maxNbChars = 150, $indexSize = 5),
    ];
});
