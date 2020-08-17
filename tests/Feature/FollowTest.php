<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FollowTest extends TestCase
{
    /**
     * Test follow feature
     *
     * @return void
     */
    public function testFollow()
    {
        $user = UserSignInTest::userForTest();
        $user->userSignIn();
        
        $userToFollow = UserSignInTest::userForTest(true);
        
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user['access']
        ])->post('/api/follow', [
            'followed_id' => $userToFollow->id
        ]);

        $response->assertStatus(200);

        $response2 = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user['access']
        ])->post('/api/follow', [
            'followed_id' => $userToFollow->id
        ]);

        $response2->assertStatus(400);
    }

    /**
     * Test unfollow feature
     * 
     * @return void
     */
    public function testUnfollow()
    {
        $user = UserSignInTest::userForTest();
        $user->userSignIn();
        
        $userToFollow = UserSignInTest::userForTest(true);
        
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user['access']
        ])->delete('/api/unfollow', [
            'followed_id' => $userToFollow->id
        ]);

        $response->assertStatus(200);
    }

}
