<?php

use Faker\Generator as Faker;
use App\Hamsaa\Constants\Regexes;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'phone' => $faker->regexify(Regexes::PHONE_NUMBER),
        'username' => $faker->userName . '_' . $faker->numberBetween(1, 99999),
        'name' => $faker->name,
        'image' => '/profiles/user.png',
        'bio' => $faker->paragraph,
        'bio_url' => $faker->url(),
        'email' => $faker->email,
        'gender' => $faker->randomElement(['male', 'female', 'other']),
        'education' => $faker->sentence(2),
        'birthday' => $faker->dateTime(),
        'city' => $faker->city,
        'province' => $faker->word,
        'skills' => $faker->sentence,
        'interests' => $faker->sentence
    ];
});
