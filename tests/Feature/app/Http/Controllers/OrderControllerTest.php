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

        $response = $this->get('/home')
            ->assertSee($orders[0]->customer_name) 
            ->assertSee('Listado de Ordenes')
            ->assertStatus(200);
        
    }
}
