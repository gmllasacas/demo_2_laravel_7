<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Embassador;
use Faker\Generator as Faker;

$factory->define(Embassador::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
