<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\TestsTrait;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use TestsTrait;

    public function test_fail_auth(): void
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    public function test_ok_auth(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/auth', [
            'email' => $user->email,
            'password' => '12345',
            'device_name' => 'teste',
        ]);

        $response->dump();

        $response->assertStatus(200);
    }

    public function test_erro_logout(): void
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    public function test_ok_logout(): void
    {

        $token = $this->createTokenUser();

        $response = $this->postJson('/logout',[],[
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }
}
