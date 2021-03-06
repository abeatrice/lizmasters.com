<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'sort_order' => Post::max('sort_order') + 1,
        'description' => $faker->paragraph,
        'published' => $faker->randomElement(['0', '1']),
        'image_path' => $faker->image()
    ];
});
