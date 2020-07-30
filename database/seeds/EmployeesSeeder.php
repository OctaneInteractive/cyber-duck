<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 35; $i++) {
            DB::table('employees')->insert([
                'name_first' => ( $i % 2 == 0 ) ? $faker->firstNameMale() : $faker->firstNameFemale(),
                'name_last' => $faker->lastName(),
                'email' => $faker->email,
                'telephone' => mt_rand(10000000000, 99999999999),
                'company_id' => rand(1, 35),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
