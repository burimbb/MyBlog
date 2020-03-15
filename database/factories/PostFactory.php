<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'       => $faker->realText(rand(20, 30)),
        'body'        => $faker->realText(rand(300, 400)),
        'slug'        => $faker->slug(),
        'category_id' => $faker->numberBetween(1, 10),
        'cover_image' => $faker->imageUrl($width = 640, $height = 480),
        'created_at'  => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
    ];
});
