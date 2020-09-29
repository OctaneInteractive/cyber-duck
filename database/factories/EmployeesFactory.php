<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Companies;
use App\Employees;

$factory->define(Employees::class, function (Faker $faker) {
    $companyId = function ()
    {
        // Get the Auto Increment value for the `companies` table.
        $statement = DB::select("SHOW TABLE STATUS LIKE 'companies'");
        return $statement[0]->Auto_increment;
    };
    $employeeId = function ()
    {
        // Get the Auto Increment value for the `employees` table.
        $statement = DB::select("SHOW TABLE STATUS LIKE 'employees'");
        return $statement[0]->Auto_increment;
    };
    $dataForEmployees = [
        'id' => (int) $employeeId(),
        'name_first' => $faker->firstNameMale(),
        'name_last' => $faker->lastName(),
        'email' => $faker->email,
        'telephone' => mt_rand(10000000000, 99999999999),
        'company_id' => rand(1, ( $companyId() - 1 ))
    ];
    return $dataForEmployees;
});
