<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Wayne Smallman",
            'email' => 'wayne.smallman@octane.uk.net',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password' => Hash::make('e6z+CU7/(]Xa8[8KWUneQ4'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
