<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class authorizationTest extends TestCase
{
    private User $normalUser;
    private User $adminUser;
    protected function setUp(): void
    {
        parent::setUp();

        $this->normalUser = $this->createUserForTest();
        $this->adminUser = $this->createUserForTest(isAdmin: true);

    }
    public function test_create_and_edit_and_delete_button_shown_to_admin()
    {
        /**
         * 1. arrange not preparation needed
         */

        /**
         * 2. act
         */
        $response = $this->actingAs($this->adminUser)->get('/products');
        /**
         * 3. assert
         */
        $response->assertStatus(200);
        $response->assertSee('Create Product');
        $response->assertSee('edit');
        $response->assertSee('delete');
    }

    public function test_create_and_edit_and_delete_button_not_shown_to_normal_user()
    {
        /**
         * 1. arrange not preparation needed
         */

        /**
         * 2. act
         */
        $response = $this->actingAs($this->normalUser)->get('/products');
        /**
         * 3. assert
         */
        $response->assertStatus(200);
        $response->assertDontSee('Create Product');
        $response->assertDontSee('delete');

    }

    public function test_admin_user_can_reach_products_create_route()
    {
        /**
         * 1. arrange not preparation needed
         */

        /**
         * 2. act
         */
        $response = $this->actingAs($this->adminUser)->get('/products/create');
        /**
         * 3. assert
         */
        $response->assertStatus(200);
        $response->assertSee('Add Product');

    }

    public function test_normal_user_can_not_reach_products_create_route()
    {
        /**
         * 1. arrange not preparation needed
         */

        /**
         * 2. act
         */
        $response = $this->actingAs($this->normalUser)->get('/products/create');
        /**
         * 3. assert
         */
        $response->assertStatus(403);
        $response->assertDontSee('Add Product');

    }

    public function test_admin_user_can_reach_products_edit_route()
    {
        /**
         * 1. arrange
         */
        $product = Product::get()->last();

        /**
         * 2. act
         */
        $response = $this->actingAs($this->adminUser)->get('/products/'.$product->id.'/edit');
        /**
         * 3. assert
         */
        $response->assertStatus(200);
        $response->assertViewHas('product', $product);

    }

    public function test_normal_user_can_not_reach_products_edit_route()
    {
        /**
         * 1. arrange
         */
        $product = Product::get()->last();

        /**
         * 2. act
         */
        $response = $this->actingAs($this->normalUser)->get('/products/'.$product->id.'/edit');
        /**
         * 3. assert
         */
        $response->assertStatus(403);
        $response->assertDontSee('Edit Product');

    }
    /**
     * delete
     */
    public function test_product_delted_from_database(){
        //1. 
        $product = Product::factory()->create();
        //2. 
        $response = $this->actingAs($this->adminUser)->delete('products/'.$product->id);

        //3. 
        $this->assertDatabaseMissing('products', $product->toArray());
   }


    private function createUserForTest($isAdmin = false)
    {
        return User::factory()->create(['is_admin' => $isAdmin]);
    }
}