<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'user_id'     => factory(User::class)->create()->id,
        'name'        => $faker->name,
        'price'       => 3000,
        'description' => $faker->sentence(40),
        'image_url'   => $faker->sentence(5),
        'discount'    => 100,
        //
    ];
});
