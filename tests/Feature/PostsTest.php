<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use WithFaker;

    /**
     * Test retrieve posts
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

    /**
     * Test store new post
     * 
     * @return void
     */
    public function testStorePost()
    {
        $user = UserSignInTest::userForTest();
        $user->userSignIn();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user['access']
        ])->json('POST', '/api/posts', [
            'user_id' => $user['id'],
            'text' => $this->faker->realText(140)
        ]);
        
        $response->assertStatus(200);
    }

    public function testDeletePost()
    {
        
    }
}
