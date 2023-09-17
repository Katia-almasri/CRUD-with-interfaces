<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class validationTest extends TestCase
{
    private User $adminUser ;
    private Product $product ;
    protected function setUp():void{
        parent::setUp();
        $this->adminUser = $this->createAdminUserForTest();
        $this->product = $this->createProductForTest();

    }
    public function test_adding_product_not_have_errors()
    {
        $response = $this->actingAs($this->adminUser)->post('/products', [
            'name'=> '',
            'details'=> ''
        ]);
        $response->assertInvalid(['name', 'details']);

        $response->assertStatus(302);
    }

    public function test_edit_product_has_errors(){
        $response = $this->actingAs($this->adminUser)->put('products/'.$this->product->id, [
            'name'=> '',
            'details'=> ''
        ]);
        $response->assertInvalid(['name', 'details']);

        $response->assertStatus(302);

    }

    public function test_if_the_edited_product_has_same_info_in_form(){
        $response = $this->actingAs($this->adminUser)->get('products/'.$this->product->id.'/edit');
        $response->assertViewHas('product', $this->product);
        $response->assertSee('value="'.$this->product->name.'"', false);
        $response->assertStatus(200);

    }

    private function createAdminUserForTest(){
        return User::factory()->create(['is_admin'=>1]);
    }

    private function createProductForTest(){
        return Product::factory()->create();
    }
}
