<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserSignInTest extends TestCase
{
    /**
     * A test for user sign in
     *
     * @return void
     */
    public function testUserSignIn()
    {
        $user = self::userForTest();
        
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

    /**
     * Get user for test
     * @return User
     */
    public static function userForTest($toFollow = false)
    {
        $test = !$toFollow ?
            User::whereEmail("usertest@test.com")->first() :
            User::whereEmail("usertestfollow@test.com")->first();


        if ($test)
            return $test;

        return User::create([
            "name"         => "User Test",
            "username"     => !$toFollow ? "usertest" : "usertestfollow",
            "email"        => !$toFollow ? "usertest@test.com" : "usertestfollow@test.com",
            "password"     => Hash::make("qweqwe"),
            "avatar"       => "default.jpg"
        ]);
    }
}
