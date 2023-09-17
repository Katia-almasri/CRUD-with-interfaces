<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class apiTest extends TestCase
{
    public function test_show_products_in_home_page()
    {
        /**
         *  API TESTING
         */
        $response = $this->getJson('/api/second-products');
        $response->assertStatus(200);
        $expectedResponse = Product::all()->map(function ($product) {
            return $product->toArray();
        })->toArray();
        $response->assertJson($expectedResponse);
    }
}