<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\HomeSection::class, function (Faker $faker) {
    return [
        'user_id'    => factory(User::class)->create()->id,
        'introlead'  => $faker->realText(50),
        'introhead'  => $faker->realText(25),
        'infoButton' => $faker->realText(10),
    ];
});
