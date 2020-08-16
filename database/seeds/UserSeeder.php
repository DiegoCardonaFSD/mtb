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
         	[
         		'name'		 => 'Diego Cardona',
         		'email'		 => 'diego@test.com',
         		'password'   => bcrypt('12345678'),
         	],
         	[
         		'name'		 => 'Diego Cardona 2',
         		'email'		 => 'diego2@test.com',
         		'password'   => bcrypt('12345678'),
         	],
         	[
         		'name'		 => 'Diego Cardona3',
         		'email'		 => 'diego3@test.com',
         		'password'   => bcrypt('12345678'),
         	],
         ]);
         DB::table('users')->insert([
         	 [
         		'name'		=> 'administrator',
         		'email'		=> 'administrator@test.com',
         		'password'  => bcrypt('12345678'),
         		'role'		=> "admin"
         	]
         ]);

    }
}
