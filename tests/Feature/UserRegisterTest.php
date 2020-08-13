<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserRegister()
    {
        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'email' => $this->faker->email,
            'password' => 'qweqwe',
        ]);
        
        $response->assertStatus(201);
    }
}
