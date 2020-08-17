<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchPerfilTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSearchPerfil()
    {
        $user = UserSignInTest::userForTest();
        $user->userSignIn();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user['access']
        ])->json('GET', '/api/search', [
            'name' => 'a',
        ]);

        $response->assertStatus(200);
    }
}
