<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Challenge::class, function (Faker $faker) {
    return [
        'user_id'     => factory(User::class)->create()->id,
        'name'        => $faker->sentence(3),
        'description' => $faker->sentence(12),
        'image_url'   => $faker->sentence(5),
        //
    ];
});
