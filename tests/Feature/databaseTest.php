<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class databaseTest extends TestCase
{
    private Product $product;
    private User $adminUser;
    protected function setUp(): void
    {
        parent::setUp();
        $this->product = $this->createProductForTest();
        $this->adminUser = $this->createAdminUserForTest();

    }
    public function test_create_product_saved_to_database()
    {

        $response = $this->actingAs($this->adminUser)->post('/products', [
            'name' => $this->product->name,
            'details' => $this->product->details
        ]);
        // ensure status redirect
        $response->assertStatus(302);
        // ensure saved into database
        //table name and array of attributes
        $this->assertDatabaseHas('products', [
            'name' => $this->product->name,
            'details' => $this->product->details,
        ]);
        //ensure the latest product is equals to the current added product
        $lastproduct = Product::latest()->first();
        // it does not compare objects at all
        $this->assertEquals($lastproduct['name'], $this->product->name);
    }

    public function test_values_edited_product_same_product_want_to_edit(){
        $response = $this->actingAs($this->adminUser)->get('/products/'.$this->product->id.'/edit');
        $response->assertStatus(200);
        //only with return 200 code we can use viewHas because 302 is redirecting and we dont have specifc view
        $response->assertViewHas('product', $this->product);
        $response->assertSee('value="'.$this->product->name.'"', false);

    }

    private function createProductForTest()
    {
        return Product::create([
            'name' => 'tested product into database',
            'details' => 'tested product details into database',
        ]);
    }

    private function createAdminUserForTest()
    {
        return User::factory()->create(['is_admin' => 1]);
    }
}