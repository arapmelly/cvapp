<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@cvmama.co.ke',
            'password' => bcrypt('jacqstwo2010'),
            'user_type'=>'admin',
        ]);


        DB::table('users')->insert([
            'name' => 'Super Agent',
            'email' => 'agent@cvmama.co.ke',
            'password' => bcrypt('jacqstwo2010'),
            'user_type'=>'agent',
        ]);
    }
}
