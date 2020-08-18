<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'message' => $faker->paragraph,
        'parent_id' => rand(1, 100),
        'post_id' => rand(1, 100),
        'main_id' => 0,
        'main' => 1
    ];
});
