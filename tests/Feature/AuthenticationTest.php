<?php
use App\Models\Product;

beforeEach(function () {
    //here we can reach the helper functions inside the pest file
    $this->normalUser = createUserForTest();
    $this->adminUser = createUserForTest(isAdmin: true);
    $this->product = createProductForTest();
});

test('unauthenticated user directed to login page', function () {
    $response = $this->post('/login', [
        'email' => 'someone@gmail.com',
        'password' => 'password'
    ]);
    $response->assertDontSee('KATIA');
    $response->assertStatus(302);
});

test('authenticated user directed to home page', function () {
    $this->actingAs($this->normalUser)->get('/products')
        ->assertStatus(200)
        ->assertSee('KATIA');

});

test('create product saved to database', function () {
    $this->actingAs($this->adminUser)->post('/products', [
        'name' => $this->product->name,
        'details' => $this->product->details
    ])
        ->assertStatus(302);
    $this->assertDatabaseHas('products', [
        'name' => $this->product->name,
        'details' => $this->product->details,
    ]);



    $lastproduct = Product::latest()->first();
    /**
     * EXPECT AND TO BE IS BETTER IN PEST TESTING THAN ASSERT EQUALS
     */
    expect($lastproduct['name'])->toBe($this->product->name);


});