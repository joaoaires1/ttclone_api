<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EditPerfilTest extends TestCase
{
    /**
     * Test update perfil
     *
     * @return void
     */
    public function testEditPerfil()
    {
        $user = UserSignInTest::userForTest();
        $user->userSignIn();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $user['access']
        ])->put('/api/edit_perfil', [
            'name' => $user['name'],
            'photo' => $file
        ]);
        
        $response->assertStatus(200);
    }
}
