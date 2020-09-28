<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employees;
use Faker\Generator as Faker;

$factory->define(Employees::class, function (Faker $faker) {
    $incrementedId = App\Employees::all()->last()->id;
    return [
        'id' => (int) $incrementedId + 1,
        'name_first' => $faker->firstNameMale(),
        'name_last' => $faker->lastName(),
        'email' => $faker->email,
        'telephone' => mt_rand(10000000000, 99999999999),
        'company_id' => rand(1, $incrementedId)
    ];
});
