<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Hashtag::class, function (Faker $faker) {
    return [
        'text' => $faker->word
    ];
});
