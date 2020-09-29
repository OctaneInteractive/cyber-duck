<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 35; $i++) {
            DB::table('companies')->insert([
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'name' => $faker->company,
                'email' => $faker->email,
                'logo' => $faker->image(public_path('logos'), 100, 100, 'business', false)
            ]);
        }
    }
}
