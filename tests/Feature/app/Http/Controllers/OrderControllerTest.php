<?php

namespace Tests\Feature\app\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Product;
use App\Order;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;
   

    public function test_index(){
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $orders = factory(Order::class,5)->create([
            'product_id'    => $product->id,
            'user_id'       => $user->id,
        ]);

        $this->actingAs($user);

        $response = $this->get('/home');

        $orders = (new Order())->roleCondition()->orderBy('id', 'DESC')->paginate();

        $response->assertViewIs('admin.order.list')
            ->assertSee($orders[0]->customer_name) 
            ->assertSee('Listado de Ordenes')
            ->assertOk()
            ->assertViewHas('orders', $orders); 
        
    }


    public function test_store(){

        $product = factory(Product::class)->create();
        $user    = factory(User::class)->create();
        
        $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();
        $fakeOrder = [
            'customer_name'     => $user->name,
            'customer_email'    => $user->email,
            'customer_mobile'   => $faker->randomNumber(7),
            'total_price'       => $faker->randomNumber(7),
            'quantity'          => $faker->numberBetween(1,3),
            'product_id'        => $product->id,
            'user_id'           => $user->id,
        ];

        $this->actingAs($user);

        $response = $this->post('/order', $fakeOrder);

        //$response->assertOk();

        $order = Order::first();

        $this->assertDatabaseHas('orders', $fakeOrder);
        $this->assertEquals($order->customer_name,   $fakeOrder['customer_name']); 
        $this->assertEquals($order->customer_mobile, $fakeOrder['customer_mobile']); 

        
    }

}
