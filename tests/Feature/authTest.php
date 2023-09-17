<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class authTest extends TestCase
{

    public function test_authenticated_user_directed_to_home_page()
    {
        /**
         * 1. arrange
         */
        $user = User::find(3);
        /**
         * 2. act
         */
        $response = $this->actingAs($user)->get('/products');
        /**
         * 3. assert
         */
        $response->assertStatus(200);
        $response->assertSee('KATIA');
    }

    public function test_unauthenticated_user_directed_to_login_page()
    {
        $credential = [
            'email' => 'someone@gmail.com',
            'password' => 'password'
        ];
    
        $response = $this->post('/login',$credential);
        $response->assertDontSee('KATIA');
        $response->assertStatus(302);
    }
    

    public function test_authenticated_user_should_not_directed_again_to_login_page()
    {
        /**
         * 1. no preparing for a scenario here
         */

        /**
         * 2. act
         */
        $response = $this->post('/login', [
            "email" => 'katiaalmasri14@gmail.com',
            "password" => 'password'
        ]);

        /**
         * 3. assert
         */
        $response->assertRedirect('/products');
        $response->assertStatus(302);
        $response->assertDontSee('login');

    }
}