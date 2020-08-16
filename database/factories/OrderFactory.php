<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_name' 	=> $faker->name,
        'customer_email' 	=> $faker->email,
        'customer_mobile' 	=> $faker->phoneNumber,
        'address' 			=> $faker->address,
        'total_price' 		=> $faker->numberBetween(100000, 999999),
        'quantity' 		    => $faker->numberBetween(1, 3),
        'product_id'		=> 1,
        'user_id' 			=> $faker->numberBetween(1, 3),
    ];
});
