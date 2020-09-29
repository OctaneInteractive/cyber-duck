<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Faker\Generator as Faker;

use App\Companies;

$factory->define(Companies::class, function (Faker $faker) {
    Storage::fake('public');
    $companyId = function ()
    {
        // Get the Auto Increment value for the `companies` table.
        $statement = DB::select("SHOW TABLE STATUS LIKE 'companies'");
        return $statement[0]->Auto_increment;
    };
    $dataForCompanies = [
        'id' => (int) $companyId(),
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
        'name' => $faker->company,
        'email' => $faker->email,
        'logo' => UploadedFile::fake()->image('testing.jpg', 100, 100)
    ];
    return $dataForCompanies;
});
