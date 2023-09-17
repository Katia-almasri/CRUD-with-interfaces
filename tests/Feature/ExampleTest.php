<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    // use RefreshDatabase;
    //this for preparation the arrangement
    private User $user;
    protected function setUp(): void{
        parent::setUp();
        $this->user = $this->createNewUserForTest();
    }

    public function test_the_home_page_contains_products()
    {
        /**
         * 1. arrange the scenario
         */
        $product = Product::create([
            'name' => 'test4',
            'details' => 'details4'
        ]);
        /**
         * 2. act the url or the api 
         */
        //acting as for authentication
        $response = $this->actingAs($this->user)->get('/products');
        /**
         * 3. assertions
         */
        //to ensure this product contained in an array located in the view
        $response->assertViewHas('products', function ($products) use ($product) {
            return $products->contains($product);
        });
        $response->assertStatus(200);
    }

    public function test_last_product_appear_in_the_home_page()
    {
        //1. 
        $products = Product::factory()->count(2)->create();
        $lastProduct = $products->last();
        //2. 
        $response = $this->actingAs($this->user)->get('/products');

        //3. 
        $response->assertViewHas('products', function ($products) use ($lastProduct) {
            return $products->contains($lastProduct);
        });
    }


   
    private function createNewUserForTest(){
        return User::factory()->create();
    }
}