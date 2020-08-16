<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetPosts()
    {
        $user = UserSignInTest::userForTest();
        $user->userSignIn();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user['access']
        ])->json('GET', '/api/posts', [
            'username' => $user['username'],
            'perfil_page' => true,
            'page' => 1
        ]);
        
        $response->assertStatus(200);
    }
}
