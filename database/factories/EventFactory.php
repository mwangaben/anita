<?php

use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'title' => $faker->sentence(10),
        'body' => $faker->paragraph(12),
        'location' => $faker->city,
        'date_of_event' => Carbon::now()

    ];
});
