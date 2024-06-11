<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Department;
use App\Models\Embassador;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker, $data) {
    $superior_id = Arr::get($data, 'superior_id', null);
    $parent_id = Arr::get($data, 'parent_id', null);

    return [
        'name' => $faker->unique()->numerify('Departamento ###'),
        'superior_id' => $superior_id,
        'parent_id' => $parent_id,
        'embassador_id' => factory(Embassador::class),
    ];
});

$factory->state(Department::class, 'no_embassador', [
    'embassador_id' => null,
]);
