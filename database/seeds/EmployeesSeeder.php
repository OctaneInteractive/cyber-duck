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
        $companyId = function ()
        {
            // Get the Auto Increment value for the `companies` table.
            $statement = DB::select("SHOW TABLE STATUS LIKE 'companies'");
            return $statement[0]->Auto_increment;
        };    
        for($i = 0; $i < 35; $i++) {;
            $dataForEmployees = [
                'name_first' => ( $i % 2 == 0 ) ? $faker->firstNameMale() : $faker->firstNameFemale(),
                'name_last' => $faker->lastName(),
                'email' => $faker->email,
                'telephone' => mt_rand(10000000000, 99999999999),
                'company_id' => rand(1, ( $companyId() - 1 )),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            DB::table('employees')->insert($dataForEmployees);
        }
    }
}
