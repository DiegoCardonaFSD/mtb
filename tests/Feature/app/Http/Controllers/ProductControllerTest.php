<?php

namespace Tests\Feature\app\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testIndex(){
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();

        $response = $this->get('/');   


        $this->assertEquals(200, $response->status());
        $response->assertViewHas('product')
                ->assertSee($product->name);

    }
}
