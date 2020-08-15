<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserSignInTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserSignIn()
    {
        $user = User::userForTest();
        
        $response = $this->post('/api/login', [
            'username' => $user->username,
            'password' => 'qweqwe'
        ]);

        $response->assertStatus(200);

        $response2 = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $response['access']
        ])->get('/api/hello', []);

        $response2->assertStatus(200);
    }
}
