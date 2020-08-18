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
        // $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $orders = factory(Order::class,5)->create([
            'product_id'    => $product->id,
            'user_id'       => $user->id,
        ]);

        $this->actingAs($user);

        $response = $this->get('/home');

        $this->assertCount(5, Order::all()); 

        $orders = (new Order())->roleCondition()->orderBy('id', 'DESC')->paginate();

        $response->assertViewIs('admin.order.index')
            ->assertSee($orders[0]->id) 
            ->assertSee('Listado de Ordenes')
            ->assertOk()
            ->assertViewHas('orders', $orders); 
        
    }


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

        $response = $this->post('/order', $fakeOrder);

        //$response->assertOk();

        $order = Order::first();


        $this->assertCount(1, Order::all()); 

        $this->assertEquals($order->customer_name,   $fakeOrder['customer_name']); 
        $this->assertEquals($order->customer_mobile, $fakeOrder['customer_mobile']); 

        $response->assertRedirect("/order/preview/{$order->id}");
        $response->assertSee('order/preview');

    }

    public function test_preview(){

        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $order = factory(Order::class)->create([
            'product_id'    => $product->id,
            'user_id'       => $user->id,
        ]);

        
        $this->actingAs($user);

        $this->assertCount(1, Order::all()); 

        $response = $this->get("/order/preview/{$order->id}");

        $response->assertViewIs('admin.order.preview')
            ->assertSee($order->customer_name) 
            ->assertSee($order->customer_email) 
            ->assertSee('Resumen de la Orden')
            ->assertOk()
            ->assertViewHas('order', $order); 
        
    }

    public function test_edit(){

        $product = factory(Product::class)->create();
        $user    = factory(User::class)->create();


        $order = factory(Order::class)->create([
            'product_id'    => $product->id,
            'user_id'       => $user->id,
        ]);
        

        // $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();
        $fakeOrder = [
            'document_type'     => $faker->randomElement(array ('CC', 'CE', 'TI', 'RC', 'NIT', 'RUT')),
            'document'          => $faker->numberBetween(100000, 999999),
            'customer_name'     => $faker->firstName,
            'customer_lastname' => $faker->lastName,
            'customer_email'    => $faker->email,
            'customer_mobile'   => $faker->randomNumber(7),
            'total_price'       => $faker->randomNumber(7),
            'quantity'          => $faker->numberBetween(1,3),
            'address'           => $faker->address,
            'product_id'        => $product->id,
            'user_id'           => $user->id,
        ];

        $this->actingAs($user);

        $response = $this->put("/order/{$order->id}", $fakeOrder);

        $order = $order->fresh();
        
        $this->assertEquals($order->customer_name,   $fakeOrder['customer_name']); 
        $this->assertEquals($order->customer_mobile, $fakeOrder['customer_mobile']); 

        $response->assertRedirect("/order/preview/{$order->id}");
        
    }


    public function test_delete(){

        $product = factory(Product::class)->create();
        $user    = factory(User::class)->create();


        $order = factory(Order::class)->create([
            'product_id'    => $product->id,
            'user_id'       => $user->id,
        ]);
        

        // $this->withoutExceptionHandling();
    
        $this->actingAs($user);

        $this->assertCount(1, Order::all()); 

        $response = $this->delete("/order/{$order->id}");

        $this->assertCount(0, Order::all()); 

        
        
    }

}
