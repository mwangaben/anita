<?php

use Faker\Generator as Faker;

$factory->define(App\ContactUs::class, function (Faker $faker) {
    return [
    
    'name' => $faker->name,
    'email' => $faker->email,
    'phone' => $faker->phoneNumber,
    'message' => $faker->realText(100, 2)
    ];
});
