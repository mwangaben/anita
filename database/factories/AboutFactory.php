<?php

use Faker\Generator as Faker;

$factory->define(App\About::class, function (Faker $faker) {
    return [
          'title' => $faker->sentence(5),
          'body' => $faker->sentence(40),
          'quote' => $faker->sentence(10)
    ];
});
