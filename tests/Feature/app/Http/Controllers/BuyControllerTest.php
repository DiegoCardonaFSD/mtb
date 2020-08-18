<?php

namespace Tests\Feature\app\http\controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Product;
use App\Order;

class BuyControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_store(){

        $product = factory(Product::class)->create();
        $user    = factory(User::class)->create();
        
        // $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();
        $fakeOrder = [
            'document_type'     => $faker->randomElement(array ('CC', 'CE', 'TI', 'RC', 'NIT', 'RUT')),
            'document'          => $faker->numberBetween(100000, 999999),
            'customer_name'     => $faker->firstName,
            'customer_lastname' => $faker->lastName,
            'customer_email'    => $user->email,
            'customer_mobile'   => $faker->randomNumber(7),
            'total_price'       => $faker->randomNumber(7),
            'quantity'          => $faker->numberBetween(1,3),
            'address'           => $faker->address,
            'product_id'        => $product->id,
            'user_id'           => $user->id,
        ];

        $this->actingAs($user);

        $response = $this->post('/buy', $fakeOrder);
        $order = Order::first();


        $this->assertCount(1, Order::all()); 

        $this->assertEquals($order->customer_name,   $fakeOrder['customer_name']); 
        $this->assertEquals($order->customer_mobile, $fakeOrder['customer_mobile']); 

        $response->assertRedirect("/buy/preview/{$order->id}");
        $response->assertSee('buy/preview');

    }
}
