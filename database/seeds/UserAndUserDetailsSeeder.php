<?php

use Illuminate\Database\Seeder;

class UserAndUserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users')->insertGetId([
            'username' => 'admin',
            'password' => bcrypt('Passw0rd'),
            'user_type' => 1
        ]);

        DB::table('user_details')->insert([
            'user_id' => $id,
            'firstname' => 'Bane',
            'lastname' => 'Wolff',
        ]);
    }
}
