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
         		'name'		 => 'Sean Anders',
         		'email'		 => 'sean@anders.com',
         		'password'   => bcrypt('hdh88793D'),
         	],
         	[
         		'name'		 => 'John Doe',
         		'email'		 => 'john@doe.com',
         		'password'   => bcrypt('hdh88793D'),
         	],
         	[
         		'name'		 => 'Marija Kosova',
         		'email'		 => 'marija@kosova.com',
         		'password'   => bcrypt('hdh88793D'),
         	],
         ]);
         DB::table('users')->insert([
         	 [
         		'name'		=> 'administrator',
         		'email'		=> 'administrator@test.com',
         		'password'  => bcrypt('hdh88793D'),
         		'role'		=> "admin"
         	]
         ]);

    }
}
