<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Companies;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;

$factory->define(Companies::class, function (Faker $faker) {
    $incrementedId = App\Companies::all()->last()->id;
    Storage::fake('logos');
    return [
        'id' => (int) $incrementedId + 1,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
        'name' => $faker->company,
        'email' => $faker->email,
        'logo' => UploadedFile::fake()->image('testing.jpg', 100, 100)
    ];
});
