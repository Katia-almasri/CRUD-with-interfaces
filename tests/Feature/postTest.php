<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class postTest extends TestCase
{
  /**
   * THIS TEST CLASS IS FOR TDD ONLY
   */
    public function test_unahtenticated_user_redirected_to_login()
    {
        $response = $this->get('/posts');

        $response->assertStatus(302);

        $response->assertRedirect('login');
    }
}
