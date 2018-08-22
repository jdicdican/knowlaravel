<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAndUserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $population = array(
            array('username' => 'admin', 'password' => 'welcome', 'user_type' => 1, 'firstname' => 'Bane', 'lastname' => 'Wolff'),
            array('username' => 'john', 'password' => 'welcome', 'user_type' => 2, 'firstname' => 'John Gerald', 'lastname' => 'Agbayani'),
            );

        foreach ($population as $person) {
            $id = DB::table('users')->insertGetId([
                'username' => $person['username'],
                'password' => Hash::make($person['password']),
                'user_type' => $person['user_type']
            ]);
    
            DB::table('user_details')->insert([
                'user_id' => $id,
                'firstname' => $person['firstname'],
                'lastname' => $person['lastname'],
            ]);
        }
    }
}
