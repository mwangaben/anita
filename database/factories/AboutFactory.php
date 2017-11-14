<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\About::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'title'   => $faker->sentence(5),
        'body'    => $faker->sentence(40),
        'quote'   => $faker->sentence(10),
    ];
});
